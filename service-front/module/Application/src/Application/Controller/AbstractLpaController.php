<?php
namespace Application\Controller;

use Zend\Mvc\MvcEvent;
use Application\Model\FormFlowChecker;
use Opg\Lpa\DataModel\Lpa\Lpa;

abstract class AbstractLpaController extends AbstractAuthenticatedController implements LpaAwareInterface
{
    private $lpa;
    
    public function onDispatch(MvcEvent $e)
    {
        # uncomment below line to bypass form flow checker.
        return parent::onDispatch($e);
        
        /**
         * check the requested route and redirect user to the correct one if the requested route is not available.
         */   
        $checker = new FormFlowChecker($this->getLpa());
        $checker->setLpa($this->getLpa());
        $currentRoute = $e->getRouteMatch()->getMatchedRouteName();
        $personIndex = $e->getRouteMatch()->getParam('person_index');
        
        $calculatedRoute = $checker->check($currentRoute, $personIndex);

        if($calculatedRoute && ($calculatedRoute != $currentRoute)) {
            return $this->redirect()->toRoute($calculatedRoute);
        }
        
        return parent::onDispatch($e);
        
    }
    
    /**
     * @return the $lpa
     */
    public function getLpa ()
    {
        if(!($this->lpa instanceof Lpa)) $this->lpa = new Lpa();
        return $this->lpa;
    }
    
    /**
     * @param field_type $lpa
     */
    public function setLpa ( Lpa $lpa )
    {
        $this->lpa = $lpa;
    }
    
}
