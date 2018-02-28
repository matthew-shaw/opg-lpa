<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Mvc\Service;

use Interop\Container\ContainerInterface;
use Zend\Mvc\DispatchListener;
use Zend\ServiceManager\Factory\FactoryInterface;

class DispatchListenerFactory implements FactoryInterface
{
    /**
     * Create the default dispatch listener.
     *
     * @param  ContainerInterface $container
     * @param  string $name
     * @param  null|array $options
     * @return DispatchListener
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        return new DispatchListener($container->get('ControllerManager'));
    }
}
