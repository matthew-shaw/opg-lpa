<?php

namespace Application\Model\Rest\Stats;

use Application\Library\ApiProblem\ApiProblem;
use Application\Model\Rest\AbstractResource;
use MongoDB\BSON\ObjectID as MongoId;
use MongoDB\BSON\Regex;
use MongoDB\BSON\UTCDateTime as MongoDate;
use MongoDB\Driver\ReadPreference;
use Opg\Lpa\DataModel\Lpa\Document\Document;
use Opg\Lpa\DataModel\WhoAreYou\WhoAreYou;
use DateTime;

class Resource extends AbstractResource
{
    public function getIdentifier()
    {
        return 'type';
    }

    public function getName()
    {
        return 'stats';
    }

    public function getType()
    {
        return self::TYPE_COLLECTION;
    }

    public function fetch($type)
    {
        switch ($type) {
            case 'lpas':
                return new Entity($this->getLpaStats());
            case 'whoareyou':
                return new Entity($this->getWhoAreYou());
            case 'lpasperuser':
                return new Entity($this->getLpasPerUser());
            case 'welshlanguage':
                return new Entity($this->getWelshLanguageStats());
            case 'preferencesinstructions':
                return new Entity($this->getPreferencesInstructionsStats());
            default:
                return new ApiProblem(404, 'Stats type not found.');
        }
    }

    /**
     * Return general stats on LPA numbers.
     *
     * Some of this could be done using aggregate queries, however I'd rather keep the queries simple.
     * Stats are not looked at very often, so performance when done like this should be "good enough".
     *
     * @return array
     */
    private function getLpaStats()
    {
        $collection = $this->getCollection('lpa');

        // Stats can (ideally) be processed on a secondary.
        $readPreference = [
            'readPreference' => new ReadPreference(ReadPreference::RP_SECONDARY_PREFERRED)
        ];

        // Broken down by month
        $byMonth = [];

        $start = new DateTime('first day of this month');
        $start->setTime(0, 0, 0);

        $end = new DateTime('last day of this month');
        $end->setTime(23, 59, 59);

        // Go back 4 months...
        for ($i = 1; $i <= 4; $i++) {
            $month = [];

            // Create MongoDate date range
            $dateRange = [
                '$gte' => new MongoDate($start),
                '$lte' => new MongoDate($end)
            ];

            // Started if we have a startedAt, but no createdAt...
            $month['started'] = $collection->count([
                'startedAt' => $dateRange
            ], $readPreference);

            // Created if we have a createdAt, but no completedAt...
            $month['created'] = $collection->count([
                'createdAt' => $dateRange
            ], $readPreference);

            // Count all the LPAs that have a completedAt...
            $month['completed'] = $collection->count([
                'completedAt' => $dateRange
            ], $readPreference);

            $byMonth[date('Y-m', $start->getTimestamp())] = $month;

            // Modify dates, going back on month...
            $start->modify("first day of -1 month");
            $end->modify("last day of -1 month");
        }

        $summary = [];

        // Broken down by type
        $pf = [];

        // Started if we have a startedAt, but no createdAt...
        $summary['started'] = $pf['started'] = $collection->count([
            'startedAt' => [
                '$ne' => null
            ],
            'createdAt' => null,
            'document.type' => Document::LPA_TYPE_PF
        ], $readPreference);

        // Created if we have a createdAt, but no completedAt...
        $summary['created'] = $pf['created'] = $collection->count([
            'createdAt' => [
                '$ne' => null
            ],
            'completedAt' => null,
            'document.type' => Document::LPA_TYPE_PF
        ], $readPreference);

        // Count all the LPAs that have a completedAt...
        $summary['completed'] = $pf['completed'] = $collection->count([
            'completedAt' => [
                '$ne' => null
            ],
            'document.type' => Document::LPA_TYPE_PF
        ], $readPreference);

        $hw = [];

        // Started if we have a startedAt, but no createdAt...
        $summary['started'] += $hw['started'] = $collection->count([
            'startedAt' => [
                '$ne' => null
            ],
            'createdAt' => null,
            'document.type' => Document::LPA_TYPE_HW
        ], $readPreference);

        // Created if we have a createdAt, but no completedAt...
        $summary['created'] += $hw['created'] = $collection->count([
            'createdAt' => [
                '$ne' => null
            ],
            'completedAt' => null,
            'document.type' => Document::LPA_TYPE_HW
        ], $readPreference);

        // Count all the LPAs that have a completedAt...
        $summary['completed'] += $hw['completed'] = $collection->count([
            'completedAt' => [
                '$ne' => null
            ],
            'document.type' => Document::LPA_TYPE_HW
        ], $readPreference);

        // Deleted LPAs have no 'document'...
        $summary['deleted'] = $collection->count([
            'document' => [
                '$exists' => false
            ]
        ], $readPreference);

        return [
            'all' => $summary,
            'health-and-welfare' => $hw,
            'property-and-finance' => $pf,
            'by-month' => $byMonth
        ];
    }

    /**
     * Return a breakdown of the Who Are You stats.
     *
     * @return array
     */
    private function getWhoAreYou()
    {
        $results = [];

        $firstDayOfThisMonth = strtotime('first day of ' . date('F Y'));

        $lastTimestamp = time(); // initially set to now...

        for ($i = 0; $i < 4; $i++) {
            $ts = strtotime("-{$i} months", $firstDayOfThisMonth);

            $results['by-month'][date('Y-m', $ts)] = $this->getWhoAreYouStatsForTimeRange($ts, $lastTimestamp);

            $lastTimestamp = $ts;
        }

        $results['all'] = $this->getWhoAreYouStatsForTimeRange(0, time());

        return $results;
    }

    /**
     * Return the WhoAreYou values for a specific date range.
     *
     * @param $start
     * @param $end
     * @return array
     */
    private function getWhoAreYouStatsForTimeRange($start, $end)
    {
        $collection = $this->getCollection('stats-who');

        // Stats can (ideally) be processed on a secondary.
        $readPreference = [
            'readPreference' => new ReadPreference(ReadPreference::RP_SECONDARY_PREFERRED)
        ];

        // Convert the timestamps to MongoIds
        $start = str_pad(dechex($start), 8, "0", STR_PAD_LEFT);
        $start = new MongoId($start."0000000000000000");

        $end = str_pad(dechex($end), 8, "0", STR_PAD_LEFT);
        $end = new MongoId($end."0000000000000000");

        $range = [
            '$gte' => $start,
            '$lte' => $end
        ];

        $result = [];

        // Base the groupings on the Model's data.
        $options = WhoAreYou::options();

        // For each top level 'who' level...
        foreach ($options as $topLevel => $details) {
            // Get the count for all top level...
            $result[$topLevel] = [
                'count' => $collection->count([
                    'who' => $topLevel,
                    '_id' => $range
                ], $readPreference),
            ];

            // Count all the subquestion values
            $result[$topLevel]['subquestions'] = [];

            foreach ($details['subquestion'] as $subquestion) {
                if (empty($subquestion)) {
                    continue;
                }

                $result[$topLevel]['subquestions'][$subquestion] = $collection->count([
                    'who' => $topLevel,
                    'subquestion' => $subquestion,
                    '_id' => $range
                ], $readPreference);
            }
        }

        return $result;
    }

    /**
     * Returns a list of lpa counts and user counts, in order to
     * answer questions of the form how many users have five LPAs?
     *
     * This data comes from a pre-generated cache.
     *
     * @return array
     *
     * The key of the return array is the number of LPAs
     * The value is the number of users with this many LPAs
     */
    private function getLpasPerUser()
    {
        $collection = $this->getCollection('stats-lpas');

        // Return all the cached data.// Stats can (ideally) be processed on a secondary.
        $readPreference = [
            'readPreference' => new ReadPreference(ReadPreference::RP_SECONDARY_PREFERRED)
        ];

        // Stats can (ideally) be pulled from a secondary.
        $cachedStats = $collection->find([], $readPreference);

        $byLpaCount = [];

        foreach ($cachedStats as $stat) {
            $byLpaCount[$stat['_id']] = $stat['count'];
        }

        return [
            'byLpaCount' => $byLpaCount,
        ];
    }

    private function getWelshLanguageStats()
    {
        $collection = $this->getCollection('lpa');

        // Stats can (ideally) be processed on a secondary.
        $readPreference = [
            'readPreference' => new ReadPreference(ReadPreference::RP_SECONDARY_PREFERRED)
        ];

        $welshLanguageStats = [];

        $start = new DateTime('first day of this month');
        $start->setTime(0, 0, 0);

        $end = new DateTime('last day of this month');
        $end->setTime(23, 59, 59);

        // Go back 4 months...
        for ($i = 1; $i <= 4; $i++) {
            $month = [];

            // Create MongoDate date range
            $dateRange = [
                '$gte' => new MongoDate($start),
                '$lte' => new MongoDate($end)
            ];

            $month['completed'] = $collection->count([
                'completedAt' => $dateRange
            ], $readPreference);

            $month['contactInEnglish'] = $collection->count([
                'completedAt' => $dateRange,
                'document.correspondent' => [
                    '$ne' => null
                ], 'document.correspondent.contactInWelsh' => false
            ], $readPreference);

            $month['contactInWelsh'] = $collection->count([
                'completedAt' => $dateRange,
                'document.correspondent' => [
                    '$ne' => null
                ], 'document.correspondent.contactInWelsh' => true
            ], $readPreference);

            $welshLanguageStats[date('Y-m', $start->getTimestamp())] = $month;

            $start->modify("first day of -1 month");
            $end->modify("last day of -1 month");
        }

        return $welshLanguageStats;
    }

    private function getPreferencesInstructionsStats()
    {
        $collection = $this->getCollection('lpa');

        // Stats can (ideally) be processed on a secondary.
        $readPreference = [
            'readPreference' => new ReadPreference(ReadPreference::RP_SECONDARY_PREFERRED)
        ];

        $preferencesInstructionsStats = [];

        $start = new DateTime('first day of this month');
        $start->setTime(0, 0, 0);

        $end = new DateTime('last day of this month');
        $end->setTime(23, 59, 59);

        // Go back 4 months...
        for ($i = 1; $i <= 4; $i++) {
            $month = [];

            // Create MongoDate date range
            $dateRange = [
                '$gte' => new MongoDate($start),
                '$lte' => new MongoDate($end)
            ];

            $month['completed'] = $collection->count([
                'completedAt' => $dateRange
            ], $readPreference);

            $month['preferencesStated'] = $collection->count([
                'completedAt' => $dateRange,
                'document.preference' => new Regex('.+', '')
            ], $readPreference);

            $month['instructionsStated'] = $collection->count([
                'completedAt' => $dateRange,
                'document.instruction' => new Regex('.+', '')
            ], $readPreference);

            $preferencesInstructionsStats[date('Y-m', $start->getTimestamp())] = $month;

            $start->modify("first day of -1 month");
            $end->modify("last day of -1 month");
        }

        return $preferencesInstructionsStats;
    }
}
