<?php

namespace Application\Model\Rest\CertificateProvider;

use Application\Library\ApiProblem\ApiProblem;
use Application\Library\ApiProblem\ValidationApiProblem;
use Application\Model\Rest\AbstractOLDResource;
use Application\Model\Rest\LpaConsumerInterface;
use Opg\Lpa\DataModel\Lpa\Document\CertificateProvider;
use RuntimeException;

class Resource extends AbstractOLDResource implements LpaConsumerInterface
{
    /**
     * Resource name
     *
     * @var string
     */
    protected $name = 'certificate-provider';

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
     * @param  mixed $id
     * @return Entity|ApiProblem
     * @throw UnauthorizedException If the current user is not authorized.
     */
    public function fetch(){

        $this->checkAccess();

        //---

        $lpa = $this->getLpa();

        return new Entity( $lpa->document->certificateProvider, $lpa );

    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|Entity
     */
    public function update($data, $id){

        $this->checkAccess();

        //---

        $lpa = $this->getLpa();

        $document = $lpa->document;

        $document->certificateProvider = new CertificateProvider( $data );

        //---

        $validation = $document->certificateProvider->validate();

        if( $validation->hasErrors() ){
            return new ValidationApiProblem( $validation );
        }

        //---

        if( $lpa->validate()->hasErrors() ){

            /*
             * This is not based on user input (we already validated the Document above),
             * thus if we have errors here it is our fault!
             */
            throw new RuntimeException('A malformed LPA object');

        }

        $this->updateLpa( $lpa );

        return new Entity( $lpa->document->certificateProvider, $lpa );

    } // function

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|bool
     * @throw UnauthorizedException If the current user is not authorized.
     */
    public function delete(){

        $this->checkAccess();

        //------------------------

        $lpa = $this->getLpa();

        $document = $lpa->document;

        $document->certificateProvider = null;

        //---

        $validation = $document->validate();

        if( $validation->hasErrors() ){
            return new ValidationApiProblem( $validation );
        }

        //---

        if( $lpa->validate()->hasErrors() ){

            /*
             * This is not based on user input (we already validated the Document above),
             * thus if we have errors here it is our fault!
             */
            throw new RuntimeException('A malformed LPA object');

        }

        $this->updateLpa( $lpa );

        return true;

    } // function

} // class
