<?php

namespace ApplicationTest\Controller\Authenticated\Lpa;

use Application\Controller\Authenticated\Lpa\IndexController;
use ApplicationTest\Controller\AbstractControllerTest;
use OpgTest\Lpa\DataModel\FixturesData;
use Zend\Http\Response;

class IndexControllerTest extends AbstractControllerTest
{
    public function testIndexActionNoSeed()
    {
        $controller = $this->getController(IndexController::class);

        $response = new Response();

        $this->lpa->document->type = null;

        $this->metadata->shouldReceive('setAnalyticsReturnCount')
            ->withArgs([$this->lpa, 5])->once();
        $this->redirect->shouldReceive('toRoute')
            ->withArgs(['lpa/form-type', ['lpa-id' => $this->lpa->id], []])->andReturn($response)->once();

        $result = $controller->indexAction();

        $this->assertEquals($response, $result);
    }

    public function testIndexActionSeed()
    {
        $controller = $this->getController(IndexController::class);

        $response = new Response();

        $seedLpa = FixturesData::getHwLpa();
        $this->lpa->seed = $seedLpa->id;

        $this->metadata->shouldReceive('setAnalyticsReturnCount')
            ->withArgs([$this->lpa, 5])->once();

        $this->setRedirectToRoute('lpa/view-docs', $this->lpa, $response);

        $result = $controller->indexAction();

        $this->assertEquals($response, $result);
    }
}
