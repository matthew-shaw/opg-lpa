<?php

namespace Application\Controller\Authenticated\Lpa;

use Application\Controller\AbstractLpaController;
use Opg\Lpa\DataModel\Lpa\Payment\Calculator;
use Zend\View\Model\ViewModel;

class SummaryController extends AbstractLpaController
{
    public function indexAction()
    {
        $fromPage = $this->params()->fromRoute('from-page');

        $isRepeatApplication = ($this->getLpa()->repeatCaseNumber != null);

        $lowIncomeFee = Calculator::getLowIncomeFee( $isRepeatApplication );
        $lowIncomeFee = (floor( $lowIncomeFee ) == $lowIncomeFee ) ? $lowIncomeFee : money_format('%i', $lowIncomeFee);

        $fullFee = Calculator::getFullFee( $isRepeatApplication );
        $fullFee = (floor( $fullFee ) == $fullFee ) ? $fullFee : money_format('%i', $fullFee);

        $viewParams = [
            'returnRoute' => 'lpa/' . $fromPage,
            'fullFee' => $fullFee,
            'lowIncomeFee' => $lowIncomeFee,
        ];

        return new ViewModel($viewParams);
    }
}
