<?php

namespace ApplicationTest\Controller\Authenticated\Lpa;

use Application\Controller\Authenticated\Lpa\WhoAreYouController;
use Application\Form\Lpa\WhoAreYouForm;
use ApplicationTest\Controller\AbstractControllerTest;
use Mockery;
use Mockery\MockInterface;
use Opg\Lpa\DataModel\Lpa\Lpa;
use OpgTest\Lpa\DataModel\FixturesData;
use RuntimeException;
use Zend\View\Model\ViewModel;

class WhoAreYouControllerTest extends AbstractControllerTest
{
    /**
     * @var WhoAreYouController
     */
    private $controller;
    /**
     * @var MockInterface|WhoAreYouForm
     */
    private $form;
    /**
     * @var Lpa
     */
    private $lpa;

    public function setUp()
    {
        $this->controller = new WhoAreYouController();
        parent::controllerSetUp($this->controller);

        $this->form = Mockery::mock(WhoAreYouForm::class);
        $this->lpa = FixturesData::getPfLpa();
        $this->formElementManager->shouldReceive('get')->with('Application\Form\Lpa\WhoAreYouForm', ['lpa' => $this->lpa])->andReturn($this->form);
    }

    /**
     * @expectedException        RuntimeException
     * @expectedExceptionMessage A LPA has not been set
     */
    public function testIndexActionNoLpa()
    {
        $this->controller->indexAction();
    }

    public function testIndexActionGet()
    {
        $this->controller->setLpa($this->lpa);
        $this->setMatchedRouteName($this->controller, 'lpa/who-are-you');
        $this->request->shouldReceive('isPost')->andReturn(false)->once();
        $this->form->shouldReceive('bind')->with(['whoIsRegistering' => $this->lpa->document->whoIsRegistering])->once();

        /** @var ViewModel $result */
        $result = $this->controller->indexAction();

        $this->assertInstanceOf(ViewModel::class, $result);
        $this->assertEquals('', $result->getTemplate());
        $this->assertEquals($this->form, $result->getVariable('form'));
    }
}