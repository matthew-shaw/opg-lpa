<?php

namespace Application\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\Mvc\Application;
use Laminas\Router\RouteMatch;
use Laminas\ServiceManager\Factory\FactoryInterface;

class RouteNameFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return RouteName
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var Application $application */
        $application = $container->get('Application');

        /** @var RouteMatch $routeMatch */
        $routeMatch = $application->getMvcEvent()->getRouteMatch();

        return new RouteName($routeMatch);
    }
}
