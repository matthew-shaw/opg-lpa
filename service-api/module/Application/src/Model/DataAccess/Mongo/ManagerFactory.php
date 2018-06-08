<?php

namespace Application\Model\DataAccess\Mongo;

use Interop\Container\ContainerInterface;
use MongoDB\Driver\Manager;
use Zend\ServiceManager\Factory\FactoryInterface;
use Exception;

class ManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Manager
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        if (strpos($requestedName, ManagerFactory::class . '-') !== 0) {
            throw new Exception(sprintf('To retrieve %s a requestName in the format %s-[configKey] must be used', get_class($this), get_class($this)));
        }

        $configKey = str_replace(ManagerFactory::class . '-', '', $requestedName);

        $config = $container->get('config')['db']['mongo'][$configKey];

        // Split the array out into comma separated values.
        $uri = 'mongodb://' . implode(',', $config['hosts']) . '/' . $config['options']['db'];

        $options = $config['options'];

        if (array_key_exists('socketTimeoutMS', $options)) {
            if (is_int($options['socketTimeoutMS'])) {
                // This connection option only works on the url itself
                $uri .= '?socketTimeoutMS=' . $options['socketTimeoutMS'];
            }
            unset($options['socketTimeoutMS']);
        }

        return new Manager($uri, $options, $config['driverOptions']);
    }
}
