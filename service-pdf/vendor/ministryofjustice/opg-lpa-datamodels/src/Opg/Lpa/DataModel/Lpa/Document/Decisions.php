<?php
namespace Opg\Lpa\DataModel\Lpa\Document;

use Opg\Lpa\DataModel\Lpa\AbstractData;
use Opg\Lpa\DataModel\Lpa\Elements;

use Respect\Validation\Rules;
use Opg\Lpa\DataModel\Validator\Validator;

class Decisions extends AbstractData {

    const LPA_DECISION_HOW_MIXED = 'mixed';
    const LPA_DECISION_HOW_JOINTLY = 'jointly';
    const LPA_DECISION_HOW_SINGLE_ATTORNEY = 'single-attorney';
    const LPA_DECISION_HOW_JOINTLY_AND_SEVERALLY = 'jointly-attorney-severally';

    const LPA_DECISION_WHEN_NOW = 'now';
    const LPA_DECISION_WHEN_NO_CAPACITY = 'no-capacity';

    protected $how;
    protected $when;
    protected $canSustainLife;

    public function __construct( $data = null ){

        //-----------------------------------------------------
        // Validators (wrapped in Closures for lazy loading)

        $this->validators['how'] = function(){
            return (new Validator)->addRules([
                new Rules\String,
                new Rules\In([
                    self::LPA_DECISION_HOW_MIXED,
                    self::LPA_DECISION_HOW_JOINTLY,
                    self::LPA_DECISION_HOW_SINGLE_ATTORNEY,
                    self::LPA_DECISION_HOW_JOINTLY_AND_SEVERALLY
                ], true ),
            ]);
        };

        $this->validators['when'] = function(){
            return (new Validator)->addRules([
                new Rules\String,
                new Rules\In( [ self::LPA_DECISION_WHEN_NOW, self::LPA_DECISION_WHEN_NO_CAPACITY ], true ),
            ]);
        };

        $this->validators['canSustainLife'] = function(){
            return (new Validator)->addRule((new Rules\OneOf)->addRules([
                new Rules\Bool,
                new Rules\NullValue,
            ]));
        };

        //---

        parent::__construct( $data );

    } // function

} // class
