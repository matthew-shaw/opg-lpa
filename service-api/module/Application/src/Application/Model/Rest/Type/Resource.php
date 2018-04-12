<?php

namespace Application\Model\Rest\Type;

use Application\Library\ApiProblem\ValidationApiProblem;
use Application\Model\Rest\AbstractResource;
use Application\Model\Rest\LpaConsumerInterface;
use RuntimeException;

class Resource extends AbstractResource implements LpaConsumerInterface
{
    /**
     * @param $data
     * @param $id
     * @return ValidationApiProblem|Entity
     */
    public function update($data, $id)
    {
        $this->checkAccess();

        $lpa = $this->getLpa();

        $lpa->document->type = (isset($data['type']) ? $data['type'] : null);

        $validation = $lpa->document->validate();

        if ($validation->hasErrors()) {
            return new ValidationApiProblem($validation);
        }

        if ($lpa->validate()->hasErrors()) {
            //  This is not based on user input (we already validated the Document above) - thus if we have errors here it is our fault!
            throw new RuntimeException('A malformed LPA object');
        }

        $this->updateLpa($lpa);

        return new Entity($lpa->document->type, $lpa);
    }
}
