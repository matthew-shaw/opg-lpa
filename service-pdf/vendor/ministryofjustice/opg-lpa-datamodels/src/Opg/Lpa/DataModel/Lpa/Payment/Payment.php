<?php
namespace Opg\Lpa\DataModel\Lpa\Payment;

use Opg\Lpa\DataModel\Lpa\AbstractData;

use Respect\Validation\Rules;
use Opg\Lpa\DataModel\Validator\Validator;
use Opg\Lpa\DataModel\Lpa\Elements;

/**
 * Represents payment information associated with an LPA.
 *
 * Class Payment
 * @package Opg\Lpa\DataModel\Lpa\Payment
 */
class Payment extends AbstractData {

    const PAYMENT_TYPE_CARD = 'card';
    const PAYMENT_TYPE_CHEQUE = 'cheque';

    /**
     * @var string The payment method used (or that will be used).
     */
    protected $method;

    /**
     * @var string The phone number that should be used regarding payment.
     */
    protected $phone;

    /**
     * @var int|float The amount that has or should be charged.
     */
    protected $amount;

    /**
     * @var string A payment reference number.
     */
    protected $reference;

    public function __construct( $data = null ){

        //-----------------------------------------------------
        // Type mappers

        $this->typeMap['phone'] = function($v){
            return ($v instanceof Elements\PhoneNumber) ? $v : new Elements\PhoneNumber( $v );
        };

        //-----------------------------------------------------
        // Validators (wrapped in Closures for lazy loading)

        $this->validators['method'] = function(){
            return (new Validator)->addRules([
                new Rules\String,
                new Rules\In( [ self::PAYMENT_TYPE_CARD, self::PAYMENT_TYPE_CHEQUE ], true ),
            ]);
        };

        $this->validators['reference'] = function(){
            return (new Validator)->addRule((new Rules\OneOf)->addRules([
                new Rules\Instance( 'Opg\Lpa\DataModel\Lpa\Elements\PhoneNumber' ),
                new Rules\NullValue,
            ]));
        };

        $this->validators['amount'] = function(){
            return (new Validator)->addRules([
                new Rules\Float,
            ]);
        };

        $this->validators['reference'] = function(){
            return (new Validator)->addRule((new Rules\OneOf)->addRules([
                new Rules\String,
                new Rules\NullValue,
            ]));
        };

        //---

        parent::__construct( $data );

    } // function

} // class
