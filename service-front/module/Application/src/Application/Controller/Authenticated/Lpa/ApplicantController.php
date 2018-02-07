<?php

namespace Application\Controller\Authenticated\Lpa;

use Application\Controller\AbstractLpaController;
use Opg\Lpa\DataModel\Lpa\Document\Correspondence;
use Opg\Lpa\DataModel\Lpa\Document\Decisions\PrimaryAttorneyDecisions;
use Zend\View\Model\ViewModel;

class ApplicantController extends AbstractLpaController
{
    public function indexAction()
    {
        $lpa = $this->getLpa();
        $lpaId = $lpa->id;
        $lpaDocument = $lpa->document;

        $form = $this->getFormElementManager()
                     ->get('Application\Form\Lpa\ApplicantForm', [
                         'lpa' => $lpa
                     ]);

        if ($this->request->isPost()) {
            $postData = $this->request->getPost();

            $form->setData($postData);

            if ($form->isValid()) {
                // persist data
                if ($postData['whoIsRegistering'] == Correspondence::WHO_DONOR) {
                    $applicants = Correspondence::WHO_DONOR;
                } else {
                    if (count($lpaDocument->primaryAttorneys) > 1 && $lpaDocument->primaryAttorneyDecisions->how != PrimaryAttorneyDecisions::LPA_DECISION_HOW_JOINTLY) {
                        $applicants = $form->getData()['attorneyList'];
                    } else {
                        $applicants = explode(',', $form->getData()['whoIsRegistering']);
                    }
                }

                // save applicant if the value has changed
                if ($applicants != $lpa->document->whoIsRegistering) {
                    if (!$this->getLpaApplicationService()->setWhoIsRegistering($lpaId, $applicants)) {
                        throw new \RuntimeException('API client failed to set applicant for id: ' . $lpaId);
                    }
                }

                return $this->moveToNextRoute();
            }
        } else {
            if (is_array($lpaDocument->whoIsRegistering)) {
                if (count($lpaDocument->primaryAttorneys) > 1 && $lpaDocument->primaryAttorneyDecisions->how != PrimaryAttorneyDecisions::LPA_DECISION_HOW_JOINTLY) {
                    $bindingData = [
                        'whoIsRegistering' => implode(',', array_map(function ($attorney) {
                            return $attorney->id;
                        }, $lpaDocument->primaryAttorneys)),
                        'attorneyList'     => $lpaDocument->whoIsRegistering,
                    ];
                } else {
                    $bindingData = ['whoIsRegistering' => implode(',', $lpaDocument->whoIsRegistering)];
                }

                $form->bind($bindingData);
            } else {
                $form->bind(['whoIsRegistering' => $lpaDocument->whoIsRegistering]);
            }
        }

        return new ViewModel(['form'=>$form]);
    }
}
