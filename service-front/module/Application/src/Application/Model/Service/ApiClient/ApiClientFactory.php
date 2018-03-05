<?php

namespace Application\Model\Service\ApiClient;

use Application\Model\Service\AuthClient\Client as AuthApiClient;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApiClientFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config')['api_client'];

        /** @var AuthApiClient $authApiClient */
        $authApiClient = $container->get('AuthClient');

        $client = new Client($config['api_uri'], $authApiClient);

        $auth = $container->get('AuthenticationService');

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();

            $client->setUserId($identity->id());
            $client->setToken($identity->token());
        }

        return $client;
    }
}
