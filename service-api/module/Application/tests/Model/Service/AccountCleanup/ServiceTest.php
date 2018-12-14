<?php

namespace ApplicationTest\Model\Service\AccountCleanup;

use Application\Model\DataAccess\Repository\Application\ApplicationRepositoryInterface;
use Application\Model\DataAccess\Repository\User\UserRepositoryInterface;
use Application\Model\DataAccess\Postgres\UserModel as User;
use Application\Model\Service\Users\Service as UsersService;
use ApplicationTest\Model\Service\AbstractServiceTest;
use Alphagov\Notifications\Client as NotifyClient;
use Alphagov\Notifications\Exception\NotifyException;
use Aws\Sns\SnsClient;
use DateInterval;
use DateTime;
use Exception;
use Mockery;
use Mockery\MockInterface;
use Opg\Lpa\Logger\Logger;

class ServiceTest extends AbstractServiceTest
{
    /**
     * @var MockInterface|UserRepositoryInterface
     */
    private $authUserRepository;

    /**
     * @var MockInterface|ApplicationRepositoryInterface
     */
    private $applicationRepository;

    /**
     * @var array
     */
    private $config = [
        'stack' => [
            'name' => 'unit_test'
        ],
        'notify' => [
            'api' => [
                'key' => 'DUMMYKEY',
            ],
        ],
        'log' => [
            'sns' => [
                'endpoints' => [
                    'info' => 'info_endpoint',
                ],
                'client' => []
            ]
        ]
    ];

    /**
     * @var MockInterface|NotifyClient
     */
    private $notifyClient;

    /**
     * @var MockInterface|SnsClient
     */
    private $snsClient;

    /**
     * @var MockInterface|UsersService
     */
    private $usersService;

    /**
     * @var MockInterface|Logger
     */
    private $logger;

    protected function setUp()
    {
        parent::setUp();

        //  Set up the services so they can be enhanced for each test

        $this->applicationRepository = Mockery::mock(ApplicationRepositoryInterface::class);

        $this->authUserRepository = Mockery::mock(UserRepositoryInterface::class);

        $this->notifyClient = Mockery::mock(NotifyClient::class);

        $this->snsClient = Mockery::mock(SnsClient::class);

        $this->usersService = Mockery::mock(UsersService::class);

        $this->logger = Mockery::mock(Logger::class);
    }

    public function testCleanupNone()
    {
        $this->setAccountsExpectations();

        $this->snsClient->shouldReceive('publish')
            ->withArgs(function ($message) {
                return $message['TopicArn'] === 'info_endpoint' && empty($message['Message']) === false
                    && $message['Subject'] === 'LPA Account Cleanup Notification'
                    && $message['MessageStructure'] === 'string';
            })
            ->once();

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    public function testCleanupNoneSnsPublishException()
    {
        $this->setAccountsExpectations();

        $this->snsClient->shouldReceive('publish')->once()
            ->andThrow(new Exception('Test exception'));

        $this->logger->shouldReceive('alert')->withArgs(function ($message, $extra) {
            return $message === 'Unable to send AWS SNS notification' && array_key_exists('exception', $extra);
        })->once();

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    public function testCleanupExpiredAccounts()
    {
        $this->setAccountsExpectations([new User(['id' => 1])]);

        $this->snsClient->shouldReceive('publish')
            ->once();

        $this->usersService->shouldReceive('delete')
            ->withArgs([1, 'expired']);

        $this->applicationRepository->shouldReceive('fetchByUserId')
            ->with(1)
            ->andReturn(new \ArrayIterator([]));

        $this->applicationRepository->shouldReceive('deleteById')
            ->withArgs([1])
            ->andReturnNull();

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    public function testCleanupExpiredAccountsException()
    {
        $this->setAccountsExpectations([new User(['id' => 1])]);

        $this->snsClient->shouldReceive('publish')
            ->once();

        $this->usersService->shouldReceive('delete')
            ->withArgs([1, 'expired']);

        $this->applicationRepository->shouldReceive('fetchByUserId')
            ->with(1)
            ->andReturn(new \ArrayIterator([]));

        $this->applicationRepository->shouldReceive('deleteById')
            ->withArgs([1])
            ->andReturnNull();

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    public function testCleanupOneWeekWarningAccountsSuccessful()
    {
        $lastLoginDate = new DateTime('-9 months +1 week');

        $this->setAccountsExpectations([], [new User([
            'id' => 1,
            'identity' => 'unit@test.com',
            'last_login' => clone $lastLoginDate
        ])]);

        $this->snsClient->shouldReceive('publish')->once();

        $lastLoginDate->add(DateInterval::createFromDateString('+9 months'));

        $this->notifyClient->shouldReceive('sendEmail')
            ->withArgs(['unit@test.com', '3e0cc4c8-0c2a-4d2a-808a-32407b2e6276', [
                'deletionDate' => $lastLoginDate->format('j F Y')
            ]])
            ->once();

        $this->authUserRepository->shouldReceive('setInactivityFlag')
            ->withArgs([1, '1-week-notice'])
            ->once();

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    public function testCleanupOneWeekWarningAccountsNotifyException()
    {
        $this->setAccountsExpectations([], [new User([
            'id' => 1,
            'identity' => 'unit@test.com',
            'last_login' => new DateTime('-9 months +1 week')
        ])]);

        $this->snsClient->shouldReceive('publish')
            ->once();

        $this->notifyClient->shouldReceive('sendEmail')
            ->once()
            ->andThrow(new NotifyException('Unit test exception'));

        $this->logger->shouldReceive('warn')
            ->withArgs(function ($message, $extra) {
                return $message === 'Unable to send account expiry notification'
                    && $extra['exception'] === 'Unit test exception';
            })
            ->once();

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    public function testCleanupOneWeekWarningAccountsException()
    {
        $this->setAccountsExpectations([], [new User([
            'id' => 1,
            'identity' => 'unit@test.com',
            'last_login' => new DateTime('-9 months +1 week')
        ])]);

        $this->snsClient->shouldReceive('publish')
            ->once();

        $this->notifyClient->shouldReceive('sendEmail')
            ->once()
            ->andThrow(new Exception('Unit test exception'));

        $this->logger->shouldReceive('alert')
            ->withArgs(function ($message, $extra) {
                return $message === 'Unable to send account expiry notification'
                    && $extra['exception'] === 'Unit test exception';
            })
            ->once();

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    public function testCleanupOneMonthWarningAccountsSuccessful()
    {
        $lastLoginDate = new DateTime('-8 months');

        $this->setAccountsExpectations([], [], [new User([
            'id' => 1,
            'identity' => 'unit@test.com',
            'last_login' => clone $lastLoginDate,
        ])]);

        $this->snsClient->shouldReceive('publish')
            ->once();

        $lastLoginDate->add(DateInterval::createFromDateString('+9 months'));

        $this->notifyClient->shouldReceive('sendEmail')
            ->withArgs(['unit@test.com', '0ef97354-9db2-4d52-a1cf-0aa762444cb1', [
                'deletionDate' => $lastLoginDate->format('j F Y')
            ]])
            ->once();

        $this->authUserRepository->shouldReceive('setInactivityFlag')
            ->withArgs([1, '1-month-notice'])
            ->once();

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    public function testCleanupUnactivatedAccounts()
    {
        $this->setAccountsExpectations([], [], [], [new User(['id' => 1])]);

        $this->snsClient->shouldReceive('publish')
            ->once();

        $this->usersService->shouldReceive('delete')
            ->withArgs([1, 'unactivated']);

        $serviceBuilder = new ServiceBuilder();
        $service = $serviceBuilder
            ->withApplicationRepository($this->applicationRepository)
            ->withAuthUserRepository($this->authUserRepository)
            ->withConfig($this->config)
            ->withNotifyClient($this->notifyClient)
            ->withSnsClient($this->snsClient)
            ->withUsersService($this->usersService)
            ->withLogger($this->logger)
            ->build();

        $result = $service->cleanup();

        // Function doesn't return anything
        $this->assertEquals(null, $result);
    }

    private function setAccountsExpectations(array $expiredAccounts = [], array $oneWeekWarningAccounts = [], array $oneMonthWarningAccounts = [], array $unactivatedAccounts = [])
    {
        $this->authUserRepository->shouldReceive('getAccountsInactiveSince')
            ->withArgs(function ($lastLoginBefore) {
                return $lastLoginBefore < new DateTime('-9 months +1 week')
                    && $lastLoginBefore >= new DateTime('-9 months -1 second');
            })
            ->once()
            ->andReturn($expiredAccounts);

        $this->authUserRepository->shouldReceive('getAccountsInactiveSince')
            ->withArgs(function ($lastLoginBefore, $excludeFlag = null) {
                return $lastLoginBefore < new DateTime('-8 months')
                    && $lastLoginBefore >= new DateTime('-9 months +1 week -1 second')
                    && $excludeFlag === '1-week-notice';
            })
            ->once()
            ->andReturn($oneWeekWarningAccounts);

        $this->authUserRepository->shouldReceive('getAccountsInactiveSince')
            ->withArgs(function ($lastLoginBefore, $excludeFlag = null) {
                return $lastLoginBefore >= new DateTime('-8 months -1 second')
                    && $excludeFlag === '1-month-notice';
            })
            ->once()
            ->andReturn($oneMonthWarningAccounts);

        $this->authUserRepository->shouldReceive('getAccountsUnactivatedOlderThan')
            ->withArgs(function ($olderThan) {
                return $olderThan >= new DateTime('-24 hours -1 second');
            })
            ->once()
            ->andReturn($unactivatedAccounts);
    }
}
