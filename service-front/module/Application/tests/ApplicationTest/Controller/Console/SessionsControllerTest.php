<?php

namespace ApplicationTest\Controller\Console;

use Application\Controller\Console\SessionsController;
use Application\Model\Service\Session\SessionManager;
use Application\Model\Service\System\DynamoCronLock;
use ApplicationTest\Controller\AbstractControllerTest;
use Aws\DynamoDb\SessionHandler as DynamoDbSessionHandler;
use Mockery;
use Mockery\MockInterface;
use Opg\Lpa\Logger\Logger;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\SaveHandler\SaveHandlerInterface;


class SessionsControllerTest extends AbstractControllerTest
{
    /**
     * @var SessionsController
     */
    private $controller;
    /**
     * @var MockInterface
     */
    private $serviceLocator;
    /**
     * @var MockInterface
     */
    private $dynamoCronLock;
    /**
     * @var MockInterface
     */
    private $sessionManager;
    /**
     * @var MockInterface
     */
    private $saveHandler;
    /**
     * @var MockInterface
     */
    private $logger;

    public function setUp()
    {
        parent::setUp();

        $this->controller = new SessionsController();
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = Mockery::mock(ServiceLocatorInterface::class);
        $this->serviceLocator = $serviceLocator;
        $this->controller->setServiceLocator($serviceLocator);
        $this->dynamoCronLock = Mockery::mock(DynamoCronLock::class);
        $this->serviceLocator->shouldReceive('get')->with('DynamoCronLock')->andReturn($this->dynamoCronLock)->once();
        $this->sessionManager = Mockery::mock(SessionManager::class);
        $this->serviceLocator->shouldReceive('get')->with('SessionManager')->andReturn($this->sessionManager);
        $this->saveHandler = Mockery::mock(DynamoDbSessionHandler::class);
        $this->logger = Mockery::mock(Logger::class);
        $this->logger->shouldReceive('info');
        $this->serviceLocator->shouldReceive('get')->with('Logger')->andReturn($this->logger);
    }

    public function testGcActionNoLock()
    {
        $this->dynamoCronLock->shouldReceive('getLock')->with('SessionGarbageCollection', ( 60 * 30 ))->andReturn(false)->once();
        $this->sessionManager->shouldReceive('getSaveHandler')->never();

        $result = $this->controller->gcAction();

        $this->assertNull($result);
    }

    public function testGcActionLock()
    {
        $this->dynamoCronLock->shouldReceive('getLock')->with('SessionGarbageCollection', ( 60 * 30 ))->andReturn(true)->once();
        $this->sessionManager->shouldReceive('getSaveHandler')->andReturn($this->saveHandler)->once();
        $this->saveHandler->shouldReceive('garbageCollect')->once();

        $result = $this->controller->gcAction();

        $this->assertNull($result);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}