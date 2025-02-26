<?php

namespace Opg\Lpa\Pdf;

use Opg\Lpa\DataModel\Lpa\Lpa;

/**
 * Class ContinuationSheet3
 * @package Opg\Lpa\Pdf
 */
class ContinuationSheet3 extends AbstractContinuationSheet
{
    /**
     * PDF template file name (without path) for this PDF object
     *
     * @var string
     */
    protected string $templateFileName = 'LPC_Continuation_Sheet_3.pdf';

    /**
     * Create the PDF in preparation for it to be generated - this function alone will not save a copy to the file system
     *
     * @param Lpa $lpa
     *
     * @return void
     */
    protected function create(Lpa $lpa): void
    {
        parent::create($lpa);

        $this->setData('cs3-donor-full-name', (string) $lpa->getDocument()->getDonor()->getName());

        //  Set footer data
        $this->setFooter('cs3-footer-right', 'cs3');
    }
}
