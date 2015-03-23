<?php
namespace Opg\Lpa\Pdf\Service\Forms;

use Opg\Lpa\DataModel\Lpa\Lpa;
use Opg\Lpa\DataModel\Lpa\Document\Document;
use Opg\Lpa\DataModel\Lpa\Elements\EmailAddress;
use Opg\Lpa\DataModel\Lpa\Elements\Name;
use Opg\Lpa\DataModel\Lpa\Elements\PhoneNumber;

class Lpa120 extends AbstractForm
{
    private $basePdfTemplate;
    
    public function __construct(Lpa $lpa)
    {
        parent::__construct($lpa);
        
        // generate a file path with lpa id and timestamp;
        $this->generatedPdfFilePath = $this->getTmpFilePath('PDF-LPA120');
        
        $this->basePdfTemplate = $this->pdfTemplatePath."/LPA120.pdf";
    }
    
    /**
     * Populate LPA data into PDF forms, generate pdf file and save into file path.
     * 
     * @return Form object | null
     */
    public function generate()
    {
        // check eligibility for exemption or remission.
        if(!$this->lpa->repeatCaseNumber &&
            !$this->lpa->payment->reducedFeeLowIncome && 
            !($this->lpa->payment->reducedFeeReceivesBenefits && $this->lpa->payment->reducedFeeAwardedDamages) &&
            !$this->lpa->payment->reducedFeeUniversalCredit) {
                throw new \RuntimeException("LPA120 is not available for this LPA.");
            }
        
        $pdf = PdfProcessor::getPdftkInstance($this->basePdfTemplate);
        
        $this->generatedPdfFilePath = $this->registerTempFile('LPA120');
        
        // populate forms
        $mappings = $this->dataMapping();
        
        $pdf->fillForm($mappings)
            ->flatten()
            ->saveAs($this->generatedPdfFilePath);
        
        return $this;
        
    } // function generate()
    
    /**
     * Data mapping
     * 
     * @return array
     */
    protected function dataMapping()
    {
        $mappings = array(
                'donor-full-name'   => $this->fullName($this->lpa->document->donor->name),
                'donor-address'     => implode(', ', array(
                        $this->lpa->document->donor->address->address1,
                        $this->lpa->document->donor->address->address2,
                        $this->lpa->document->donor->address->address3,
                        $this->lpa->document->donor->address->postcode
                )),
                'lpa-type-property-and-financial-affairs' => ($this->lpa->document->type==Document::LPA_TYPE_PF)?self::CHECK_BOX_ON:null,
                'lpa-type-health-and-welfare'             => ($this->lpa->document->type==Document::LPA_TYPE_HW)?self::CHECK_BOX_ON:null,
                'is-repeat-application'     => ($this->lpa->repeatCaseNumber==null)?null:self::CHECK_BOX_ON,
                'correspondent'             => $this->lpa->document->correspondent->who,
                'correspondent-name-title'  => ($this->lpa->document->correspondent->name instanceof Name)?strtolower($this->lpa->document->correspondent->name->title):null,
                'correspondent-name-first'  => ($this->lpa->document->correspondent->name instanceof Name)?$this->lpa->document->correspondent->name->first:null,
                'correspondent-name-last'   => ($this->lpa->document->correspondent->name instanceof Name)?$this->lpa->document->correspondent->name->last:$this->lpa->document->correspondent->name,
                'correspondent-address'     => implode(', ', array(
                        $this->lpa->document->correspondent->address->address1,
                        $this->lpa->document->correspondent->address->address2,
                        $this->lpa->document->correspondent->address->address3,
                        $this->lpa->document->correspondent->address->postcode
                )),
                'correspondent-phone'       => ($this->lpa->document->correspondent->phone instanceof PhoneNumber)?$this->lpa->document->correspondent->phone->number:null,
                'correspondent-name-email-address' => ($this->lpa->document->correspondent->email instanceof EmailAddress)?$this->lpa->document->correspondent->email->address:null,
                'receive-benefits'          => $this->lpa->payment->reducedFeeReceivesBenefits?'yes':'no',
                'damage-awarded'            => $this->lpa->payment->reducedFeeAwardedDamages?'no':'yes',
                'low-income'                => $this->lpa->payment->reducedFeeLowIncome?'yes':'no',
                'receive-universal-credit'  => $this->lpa->payment->reducedFeeUniversalCredit?'yes':'no'
        );
        
        return $mappings;
    } // function dataMapping()
}  // class Lpa120