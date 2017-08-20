<?php

namespace ApplicationTest\Controller\Authenticated;

use Application\Controller\Authenticated\TypeController;
use Application\Form\Lpa\TypeForm;
use ApplicationTest\Controller\AbstractControllerTest;
use Mockery\MockInterface;

class TypeControllerTest extends AbstractControllerTest
{
    /**
     * @var TypeController
     */
    private $controller;
    /**
     * @var MockInterface|TypeForm
     */
    private $form;

    public function setUp()
    {
        $this->controller = new TypeController();
        parent::controllerSetUp($this->controller);

        $this->form = Mockery::mock(Type::class);
        $this->formElementManager->shouldReceive('get')->with('Application\Form\Lpa\TypeForm')->andReturn($this->form);
    }
}