<?php
namespace Opg\Lpa\Pdf\Service\Forms;

use Opg\Lpa\DataModel\Lpa\Lpa;

class Cs4 extends AbstractForm
{
    private $companyNumber;
    
    public function __construct(Lpa $lpa, $companyNumber)
    {
        parent::__construct($lpa);
        $this->companyNumber = $companyNumber;
    }
    
    public function generate()
    {
        $filePath = $this->registerTempFile('CS4');
        
        $cs2 = PdfProcessor::getPdftkInstance($this->pdfTemplatePath.'/LPC_Continuation_Sheet_4.pdf');
        
        $cs2->fillForm(
            array(
                    'cs-4-trust-corporation-company-registration-number' => $this->companyNumber
            ))
        ->saveAs($filePath);
        
        return $this->interFileStack;
    } // function generate()
    
    public function __destruct()
    {
        
    }
} // class Cs4