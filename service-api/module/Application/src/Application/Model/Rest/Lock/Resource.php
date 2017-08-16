<?php

namespace Application\Model\Rest\Lock;

use Application\Library\ApiProblem\ApiProblem;
use Application\Library\DateTime;
use Application\Model\Rest\AbstractResource;
use Application\Model\Rest\LpaConsumerInterface;
use Application\Model\Rest\UserConsumerInterface;
use RuntimeException;

class Resource extends AbstractResource implements UserConsumerInterface, LpaConsumerInterface
{
    /**
     * Resource name
     *
     * @var string
     */
    protected $name = 'lock';

    /**
     * Resource identifier
     *
     * @var string
     */
    protected $identifier = 'lpaId';

    /**
     * Resource type
     *
     * @var string
     */
    protected $type = self::TYPE_SINGULAR;

    /**
     * Fetch a resource
     *
     * @return Entity|ApiProblem
     * @throw UnauthorizedException If the current user is not authorized.
     */
    public function fetch(){

        $this->checkAccess();

        //---

        $lpa = $this->getLpa();

        // Return false if the value is not set.
        $result = ( is_null($lpa->locked) )? false: $lpa->locked;

        return new Entity( $result, $lpa );

    }

    /**
     * Locks a LPA.
     *
     * @param  mixed $data
     * @return Entity|ApiProblem
     * @throw UnauthorizedException If the current user is not authorized.
     */
    public function create($data){

        $this->checkAccess();

        //---

        $lpa = $this->getLpa();

        if( $lpa->locked === true ){
            return new ApiProblem( 403, 'LPA already locked' );
        }

        //---

        $lpa->locked = true;
        $lpa->lockedAt = new DateTime();

        //---

        if( $lpa->validate()->hasErrors() ){

            /*
             * This is not based on user input (we already validated the Document above),
             * thus if we have errors here it is our fault!
             */
            throw new RuntimeException('A malformed LPA object was created');

        }

        //---

        $this->updateLpa( $lpa );

        //---

        return new Entity( $lpa->locked, $lpa );

    } // function

} // class
