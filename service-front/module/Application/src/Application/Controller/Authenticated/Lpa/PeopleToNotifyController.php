<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller\Authenticated\Lpa;

use Application\Controller\AbstractLpaController;
use Zend\View\Model\ViewModel;
use Opg\Lpa\DataModel\Lpa\Document\NotifiedPerson;
use Zend\View\Model\JsonModel;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;
use Application\Model\Service\Lpa\Metadata;

class PeopleToNotifyController extends AbstractLpaController
{
    
    protected $contentHeader = 'creation-partial.phtml';
    
    public function indexAction()
    {
        $currentRouteName = $this->getEvent()->getRouteMatch()->getMatchedRouteName();
        $lpaId = $this->getLpa()->id;
        
        // set hidden form for saving empty array to peopleToNotify.
        $form = new Form();
        $form->setAttribute('method', 'post');
        
        $form->add( (new Csrf('secret'))->setCsrfValidatorOptions([
                'timeout' => null,
                'salt' => sha1('Application\Form\Lpa-Salt'),
        ]));
        
        if($this->request->isPost()) {
        
            $form->setData($this->request->getPost());
        
            if($form->isValid()) {
                
                // set user has confirmed if there are people to notify
                if(!array_key_exists(Metadata::PEOPLE_TO_NOTIFY_CONFIRMED, $this->getLpa()->metadata)) {
                    $this->getServiceLocator()->get('Metadata')->setPeopleToNotifyConfirmed($this->getLpa());
                }
                
                $this->redirect()->toRoute($this->getFlowChecker()->nextRoute($currentRouteName), ['lpa-id' => $lpaId]);
            }
        }
        
        // list notified persons on the landing page if they've been added.
        $peopleToNotifyParams = [];
        foreach($this->getLpa()->document->peopleToNotify as $idx=>$peopleToNotify) {
            $peopleToNotifyParams[] = [
                    'notifiedPerson' => [
                            'name'      => $peopleToNotify->name,
                            'address'   => $peopleToNotify->address
                    ],
                    'editRoute'     => $this->url()->fromRoute( $currentRouteName.'/edit', ['lpa-id' => $lpaId, 'idx' => $idx ]),
                    'deleteRoute'   => $this->url()->fromRoute( $currentRouteName.'/delete', ['lpa-id' => $lpaId, 'idx' => $idx ]),
            ];
        }
        
        $view = new ViewModel(['form' => $form, 'peopleToNotify' => $peopleToNotifyParams]);
        
        if( count($this->getLpa()->document->peopleToNotify) < 5) {
            $view->addRoute  = $this->url()->fromRoute( $currentRouteName.'/add', ['lpa-id' => $lpaId] );
        }
        
        return $view;
    }
    
    public function addAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('application/people-to-notify/form.phtml');
        if ( $this->getRequest()->isXmlHttpRequest() ) {
            $viewModel->setTerminal(true);
        }
        
        $lpaId = $this->getLpa()->id;
        $currentRouteName = $this->getEvent()->getRouteMatch()->getMatchedRouteName();

        if(count($this->getLpa()->document->peopleToNotify) >= 5 ) {
            $this->redirect()->toRoute('lpa/people-to-notify', ['lpa-id'=>$lpaId]);
        }
        
        $form = $this->getServiceLocator()->get('FormElementManager')->get('Application\Form\Lpa\PeopleToNotifyForm');
        $form->setAttribute('action', $this->url()->fromRoute($currentRouteName, ['lpa-id' => $lpaId]));
        
        // check if there's a seed number in this LPA and get seed data if it exists.
        if(($seedDetails = $this->getSeedDetails()) != null) {
            
            // if seed exists, render a picker form for user to choose which actor's details to be auto populated into the form.
            $seedDetailsPickerForm = $this->getServiceLocator()->get('FormElementManager')->get('Application\Form\Lpa\SeedDetailsPickerForm', ['seedDetails'=>$seedDetails]);
            $seedDetailsPickerForm->setAttribute('action', $this->url()->fromRoute($currentRouteName, ['lpa-id' => $lpaId]));
            $viewModel->seedDetailsPickerForm = $seedDetailsPickerForm;
        }
        
        if($this->request->isPost()) {
            $postData = $this->request->getPost();
            
            // received a POST from the picker form
            if($postData->offsetExists('pick-details')) {
                
                // load seed data into the form or return form data in json format if request is an ajax
                $seedDetailsPickerForm->setData($this->request->getPost());
                if($seedDetailsPickerForm->isValid()) {
                    
                    $pickIdx = $this->request->getPost('pick-details');
                    
                    if(is_array($seedDetails) && array_key_exists($pickIdx, $seedDetails)) {
                        
                        // prepare data of the chosen actor for populating into the form
                        $actorData = $seedDetails[$pickIdx]['data'];
                        $formData = $this->flattenData($actorData);
                        
                        // bind data to the form or return json to ajax call
                        if ( $this->getRequest()->isXmlHttpRequest() ) {
                            return new JsonModel($formData);
                        }
                        else {
                            $form->bind($formData);
                        }
                    }
                }
            }
            else {
                // handle notified person form submission
                $form->setData($postData);
                if($form->isValid()) {
                    
                    // persist data
                    $np = new NotifiedPerson($form->getModelDataFromValidatedForm());
                    if(!$this->getLpaApplicationService()->addNotifiedPerson($lpaId, $np)) {
                        throw new \RuntimeException('API client failed to add a notified person for id: '.$lpaId);
                    }
                    
                    // remove metadata flag value if exists
                    if(!array_key_exists(Metadata::PEOPLE_TO_NOTIFY_CONFIRMED, $this->getLpa()->metadata)) {
                            $this->getServiceLocator()->get('Metadata')->setPeopleToNotifyConfirmed($this->getLpa());
                    }
                    
                    // redirect to next page for non-js, or return a json to ajax call.
                    if ( $this->getRequest()->isXmlHttpRequest() ) {
                        return new JsonModel(['success' => true]);
                    }
                    else {
                        $this->redirect()->toRoute($this->getFlowChecker()->nextRoute($currentRouteName), ['lpa-id' => $lpaId]);
                    }
                }
            }
        }
        
        $viewModel->form = $form;
        
        return $viewModel;
    }
    
    public function editAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('application/people-to-notify/form.phtml');
        if ( $this->getRequest()->isXmlHttpRequest() ) {
            $viewModel->setTerminal(true);
        }
        
        $lpaId = $this->getLpa()->id;
        $currentRouteName = $this->getEvent()->getRouteMatch()->getMatchedRouteName();
        
        $personIdx = $this->getEvent()->getRouteMatch()->getParam('idx');
        if(array_key_exists($personIdx, $this->getLpa()->document->peopleToNotify)) {
            $notifiedPerson = $this->getLpa()->document->peopleToNotify[$personIdx];
        }
        
        // if notified person idx does not exist in lpa, return 404.
        if(!isset($notifiedPerson)) {
            return $this->notFoundAction();
        }
        
        $form = $this->getServiceLocator()->get('FormElementManager')->get('Application\Form\Lpa\PeopleToNotifyForm');
        $form->setAttribute('action', $this->url()->fromRoute($currentRouteName, ['lpa-id' => $lpaId, 'idx'=>$personIdx]));
        
        if($this->request->isPost()) {
            $postData = $this->request->getPost();
            $form->setData($postData);
            
            if($form->isValid()) {
                // update details
                $notifiedPerson->populate($form->getModelDataFromValidatedForm());
                
                // persist to the api
                if(!$this->getLpaApplicationService()->setNotifiedPerson($lpaId, $notifiedPerson, $notifiedPerson->id)) {
                    throw new \RuntimeException('API client failed to update notified person ' . $personIdx . ' for id: ' . $lpaId);
                }
                
                // redirect to next page for non-js, or return a json to ajax call.
                if ( $this->getRequest()->isXmlHttpRequest() ) {
                    return new JsonModel(['success' => true]);
                }
                else {
                    $this->redirect()->toRoute($this->getFlowChecker()->nextRoute($currentRouteName), ['lpa-id' => $lpaId]);
                }
            }
        }
        else {
            $form->bind($notifiedPerson->flatten());
        }
        
        $viewModel->form = $form;
        
        return $viewModel;
    }
    
    public function deleteAction()
    {
        $lpaId = $this->getLpa()->id;
        $personIdx = $this->getEvent()->getRouteMatch()->getParam('idx');
        
        if(array_key_exists($personIdx, $this->getLpa()->document->peopleToNotify)) {
            
            // persist data to the api
            if(!$this->getLpaApplicationService()->deleteNotifiedPerson($lpaId, $this->getLpa()->document->peopleToNotify[$personIdx]->id)) {
                throw new \RuntimeException('API client failed to delete notified person ' . $personIdx . ' for id: ' . $lpaId);
            }
            
        }
        else {
            // if notified person idx does not exist in lpa, return 404.
            return $this->notFoundAction();
        }
        
        if ( $this->getRequest()->isXmlHttpRequest() ) {
            return new JsonModel(['success' => true]);
        }
        else {
            $currentRouteName = $this->getEvent()->getRouteMatch()->getMatchedRouteName();
            $this->redirect()->toRoute($this->getFlowChecker()->nextRoute($currentRouteName), ['lpa-id' => $lpaId]);
        }
    }
}
