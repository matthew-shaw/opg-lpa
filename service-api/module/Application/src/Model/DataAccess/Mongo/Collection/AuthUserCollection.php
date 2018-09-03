<?php
namespace Application\Model\DataAccess\Mongo\Collection;

use MongoDB\BSON\UTCDateTime as MongoDate;
use MongoDB\Collection as MongoCollection;
use MongoDB\Driver\Exception\Exception as MongoException;
use MongoDB\Driver\ReadPreference;
use DateTime;
use Application\Model\DataAccess\Repository\User as UserRepository;
use Opg\Lpa\DataModel\User\User as UserModel;

class AuthUserCollection extends AbstractCollection implements UserRepository\UserRepositoryInterface
{
    use ApiUserCollectionTrait;

    /**
     * @var MongoCollection
     */
    protected $collection;

    /**
     * @param MongoCollection $collection
     */
    public function __construct(MongoCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Returns a single user by username (email address).
     *
     * @param $username
     * @return User|null
     */
    public function getByUsername(string $username) : ?UserRepository\UserInterface
    {
        $data = $this->collection->findOne(['identity' => $username]);

        if (!is_array($data)) {
            return null;
        }

        return new User($data);
    }

    /**
     * @param $id
     * @return User|null
     */
    public function getById(string $id) : ?UserRepository\UserInterface
    {
        $data = $this->collection->findOne(['_id' => $id]);

        if (!is_array($data)) {
            return null;
        }

        return new User($data);
    }

    /**
     * @param $token
     * @return User|null
     */
    public function getByAuthToken(string $token) : ?UserRepository\UserInterface
    {
        $data = $this->collection->findOne(['auth_token.token' => $token]);

        if (!is_array($data)) {
            return null;
        }

        return new User($data);
    }

    /**
     * @param $token
     * @return User|null
     */
    public function getByResetToken(string $token) : ?UserRepository\UserInterface
    {
        $data = $this->collection->findOne(
            [
                'password_reset_token.token' => $token,
                'password_reset_token.expiresAt' => [
                    '$gt' => new MongoDate
                ]
            ]
        );

        if (!is_array($data)) {
            return null;
        }

        return new User($data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function updateLastLoginTime(string $id) : bool
    {
        return $this->collection->updateOne([
            '_id' => $id
        ], [
            '$set' => [
                'last_login' => new MongoDate
            ],
            '$unset' => [
                'inactivity_flags' => true  // Remove any inactivity flags that may have been set.
            ],
        ], [
            'upsert' => false,
            'multiple' => false
        ])->getModifiedCount() == 1;
    }

    /**
     * Resets the user's failed login counter to zero.
     *
     * @param $id
     * @return bool
     */
    public function resetFailedLoginCounter(string $id) : bool
    {
        return $this->collection->updateOne([
            '_id' => $id
        ], [
            '$set' => [
                'failed_login_attempts' => 0
            ]
        ], [
            'upsert' => false,
            'multiple' => false
        ])->getModifiedCount() == 1;
    }

    /**
     * Increments the user's failed login counter by 1.
     *
     * @param $id
     * @return bool
     */
    public function incrementFailedLoginCounter(string $id) : bool
    {
        return $this->collection->updateOne([
            '_id' => $id
        ], [
            '$inc' => [
                'failed_login_attempts' => 1
            ],
            '$set' => [
                'last_failed_login' => new MongoDate
            ],
        ], [
            'upsert' => false,
            'multiple' => false
        ])->getModifiedCount() == 1;
    }

    /**
     * Creates a new user account
     *
     * @param $id
     * @param array $details
     * @return bool
     */
    public function create(string $id, array $details) : bool
    {
        // Map DateTimes to MongoDates
        $details = array_map(function ($v) {
            return ($v instanceof \DateTime) ? new MongoDate($v) : $v;
        }, $details);

        try {
            $data = ['_id' => $id] + $details;

            $result = $this->collection->insertOne($data);

            return ($result->getInsertedCount() == 1);
        } catch (MongoException $e) {
            // This catches _id clashes. We don't need to handle it here.
        }

        return false;
    }

    /**
     * Delete the account for the passed user.
     *
     * NB: When an account is deleted, the document it kept, leaving only _id and a new deletedAt field.
     *
     * @param $id
     * @return bool|null
     */
    public function delete(string $id) : bool
    {
        $filter = ['_id' => $id];
        $data = $this->collection->findOne($filter);

        if (!is_array($data)) {
            return false;
        }

        $details = [
            '_id' => $id,
            'deletedAt' => new MongoDate
        ];

        $this->collection->replaceOne($filter, $details);

        //---

        // Delete the profile data
        $this->apiUserCollection->deleteById($id);

        return true;
    }

    /**
     * Activates a user account
     *
     * @param $token
     * @return bool|null
     */
    public function activate(string $token) : bool
    {
        // Check the token maps to a user...
        $user = $this->collection->findOne(['activation_token' => $token]);

        if (!is_array($user)) {
            return false;
        }

        //---

        $result = $this->collection->updateOne(
            ['_id' => $user['_id']],
            [
                '$set' => [
                    'active' => true,
                    'activated' => new MongoDate,
                    'last_updated' => new MongoDate,
                ],
                '$unset' => [
                    'activation_token' => true,
                ],
            ],
            ['upsert' => false, 'multiple' => false]
        );

        return ($result->getModifiedCount() == 1);
    }

    /**
     * Updates a user's password.
     *
     * @param $userId
     * @param $passwordHash
     * @return bool
     */
    public function setNewPassword(string $userId, string $passwordHash) : bool
    {
        $result = $this->collection->updateOne(
            ['_id' => $userId],
            [
                '$set' => [
                    'password_hash' => $passwordHash,
                    'last_updated' => new MongoDate,
                ],
                '$unset' => [
                    'auth_token' => true, // Password changes should also result in the auth token being removed.
                ],
            ],
            ['upsert' => false, 'multiple' => false]
        );

        return ($result->getModifiedCount() == 1);
    }

    /**
     * Sets a new auth token.
     *
     * @param $userId
     * @param DateTime $expires
     * @param $token
     * @return bool
     */
    public function setAuthToken(string $userId, DateTime $expires, string $token) : bool
    {
        return $this->modifyAuthToken($userId, $expires, [
            'auth_token.createdAt' => new MongoDate(),
            'auth_token.token' => $token,
        ]);
    }

    /**
     * Extends the authentication token.
     *
     * @param $userId
     * @param DateTime $expires
     * @return bool
     */
    public function extendAuthToken(string $userId, DateTime $expires) : bool
    {
        return $this->modifyAuthToken($userId, $expires);
    }

    /**
     * Modifies the auth token - either creating a new one, of extending an existing one.
     *
     *
     * @param $userId
     * @param DateTime $expires
     * @param array $set
     * @return bool
     */
    private function modifyAuthToken(string $userId, DateTime $expires, array $set = array()) : bool
    {
        $set = $set + [
            'auth_token.updatedAt' => new MongoDate(),
            'auth_token.expiresAt' => new MongoDate($expires),
        ];

        try {
            $result = $this->collection->updateOne(
                ['_id' => $userId],
                ['$set' => $set],
                ['upsert' => false, 'multiple' => false]
            );

            return ($result->getModifiedCount() == 1);
        } catch (MongoException $e) {
            // This catches auth_token.token clashes. We don't need to handle it here.
        }

        return false;
    }

    /**
     * @param $id
     * @param array $token
     * @return bool
     */
    public function addPasswordResetToken(string $id, array $token) : bool
    {
        // Map DateTimes to MongoDates
        $token = array_map(function ($v) {
            return ($v instanceof \DateTime) ? new MongoDate($v) : $v;
        }, $token);

        return $this->collection->updateOne(
            ['_id' => $id],
            ['$set' => ['password_reset_token' => $token]],
            ['upsert' => false, 'multiple' => false]
        )->getModifiedCount() == 1;
    }

    /**
     * @param $token
     * @param $passwordHash
     * @return UserRepository\UpdatePasswordUsingTokenError
     */
    public function updatePasswordUsingToken(string $token, string $passwordHash) : ?UserRepository\UpdatePasswordUsingTokenError
    {
        $user = $this->getByResetToken($token);

        if (!$user instanceof User) {
            return new UserRepository\UpdatePasswordUsingTokenError( 'invalid-token');
        }

        //---

        $result = $this->collection->updateOne(
            ['_id' => $user->id()],
            [
                '$set' => [
                    'password_hash' => $passwordHash,
                    'last_updated' => new MongoDate,
                ],
                '$unset' => [
                    'password_reset_token' => true,
                    'auth_token' => true, // Password changes should also result in the auth token being removed.
                ],
            ],
            ['upsert' => false, 'multiple' => false]
        );

        if ($result->getModifiedCount() != 1) {
            return new UserRepository\UpdatePasswordUsingTokenError('nothing-modified');
        }

        // All went well; no error to return.
        return null;
    }

    /**
     * @param $id
     * @param array $token
     * @param $newEmail
     * @return bool
     */
    public function addEmailUpdateTokenAndNewEmail(string $id, array $token, string $newEmail) : bool
    {
        // Map DateTimes to MongoDates
        $token = array_map(function ($v) {
            return ($v instanceof \DateTime) ? new MongoDate($v) : $v;
        }, $token);

        return $this->collection->updateOne([
            '_id' => $id
        ], [
            '$set' => [
                'email_update_request' => [
                    'token' => $token,
                    'email' => $newEmail,
                ],
            ],
        ], [
            'upsert' => false,
            'multiple' => false
        ])->getModifiedCount() == 1;
    }

    /**
     * @param $token
     * @return UserRepository\UpdateEmailUsingTokenResponse
     */
    public function updateEmailUsingToken(string $token) : UserRepository\UpdateEmailUsingTokenResponse
    {
        $user = $this->collection->findOne(
            [
                'email_update_request.token.token' => $token,
                'email_update_request.token.expiresAt' => ['$gt' => new MongoDate] // Now needs to be greater than expiresAt.
            ]
        );

        if (!is_array($user)) {
            return new UserRepository\UpdateEmailUsingTokenResponse('invalid-token');
        }

        $newEmail = $user['email_update_request']['email'];

        $clashUser = $this->collection->findOne(
            [
                'identity' => $newEmail
            ]
        );

        if (is_array($clashUser)) {
            return new UserRepository\UpdateEmailUsingTokenResponse('username-already-exists');
        }

        //---

        $result = $this->collection->updateOne(
            ['_id' => $user['_id']],
            [
                '$set' => [
                    'identity' => $newEmail,
                    'last_updated' => new MongoDate,
                ],
                '$unset' => [
                    'email_update_request' => true,
                ],
            ],
            ['upsert' => false, 'multiple' => false]
        );

        if ($result->getModifiedCount() != 1) {
            return new UserRepository\UpdateEmailUsingTokenResponse('nothing-modified');
        }

        // Returns the User, wrapped in a Response object.
        return new UserRepository\UpdateEmailUsingTokenResponse(new User($user));
    }

    /**
     * Returns all accounts that have not been logged into since $since.
     *
     * If $withoutFlag is set, accounts that contain the passed flag will be excluded.
     *
     * @param DateTime $since
     * @param null $excludeFlag
     * @return iterable
     */
    public function getAccountsInactiveSince(DateTime $since, ?string $excludeFlag = null) : iterable
    {
        $query = [
            '$or' => [
                ['last_login' => ['$lt' => new MongoDate($since)]],
                ['last_login' => ['$lt' => $since->getTimestamp()]],
            ],
        ];

        if (is_string($excludeFlag)) {
            $query['inactivity_flags'] = ['$nin' => [$excludeFlag]];
        }

        //---

        $users = $this->collection->find($query);

        foreach ($users as $user) {
            yield new User($user);
        }
    }

    /**
     * Adds a new inactivity flag to an account.
     *
     * @param $userId
     * @param $flag
     * @return bool
     */
    public function setInactivityFlag(string $userId, string $flag) : bool
    {
        $updateResult = $this->collection->updateOne(
            ['_id' => $userId],
            ['$addToSet' => ['inactivity_flags' => $flag]],
            ['upsert' => false, 'multiple' => false]
        );

        return $updateResult->isAcknowledged();
    }

    /**
     * Returns all accounts create before date $olderThan and that have not been activated.
     *
     * @param DateTime $olderThan
     * @return iterable
     */
    public function getAccountsUnactivatedOlderThan(DateTime $olderThan) : iterable
    {
        $users = $this->collection->find([
            'active' => ['$ne' => true],
            'created' => ['$lt' => new MongoDate($olderThan)],
        ]);

        foreach ($users as $user) {
            yield new User($user);
        }
    }

    /**
     * Counts the number of account in the system.
     *
     * @return int Account count
     */
    public function countAccounts() : int
    {
        // All accounts that have not been deleted...
        $criteria = ['identity' => ['$exists' => true]];

        //---

        // Stats can (ideally) be processed on a secondary.
        return $this->collection->count($criteria, ['readPreference' => new ReadPreference(ReadPreference::RP_SECONDARY_PREFERRED)]);
    }

    /**
     * Counts the number of ACTIVATED account in the system.
     *
     * @param DateTime|null $since only include accounts activated $since
     * @return int Account count
     */
    public function countActivatedAccounts(DateTime $since = null) : int
    {
        // All accounts that have not been deleted...
        $criteria = ['identity' => ['$exists' => true]];

        // Currently needs to support old and new data types.
        $criteria['$or'] = [
            ['active' => ['$eq' => true]],
            ['active' => ['$eq' => 'Y']],
        ];

        if ($since) {
            $criteria['activated'] = ['$gte' => new MongoDate($since)];
        }

        //---

        // Stats can (ideally) be processed on a secondary.
        return $this->collection->count($criteria, ['readPreference' => new ReadPreference(ReadPreference::RP_SECONDARY_PREFERRED)]);
    }

    /**
     * Counts the number of accounts that have been deleted.
     *
     * @return int Account count
     */
    public function countDeletedAccounts() : int
    {
        // All accounts that HAVE been deleted...
        $criteria = ['identity' => ['$exists' => false]];

        //---

        // Stats can (ideally) be processed on a secondary.
        return $this->collection->count($criteria, ['readPreference' => new ReadPreference(ReadPreference::RP_SECONDARY_PREFERRED)]);
    }

    /**
     * Return a user's profile details
     *
     * @param $id
     * @return UserModel
     */
    public function getProfile($id) : ?UserModel
    {
        $result = $this->apiUserCollection->getById($id);

        if (!is_array($result)) {
            return null;
        }

        return new UserModel(['id' => $id] + $result);
    }

    /**
     * Updates a user's profile. If it doesn't already exist, it's created.
     *
     * @param UserModel $data
     * @return bool
     */
    public function saveProfile(UserModel $data) : bool
    {
        $this->apiUserCollection->update($data);

        // Exception is thrown on error, so if here...
        return true;
    }
}
