<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 09/03/2016
 * Time: 2:23 AM
 */

namespace RbacUserDoctrineOrm\Factory;


use Interop\Container\ContainerInterface;
use RbacUserDoctrineOrm\Options\ModuleOptions;
use Zend\ServiceManager\Factory\FactoryInterface;

class ModuleOptionsFactory implements  FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        return new ModuleOptions($config['rbac-user-doctrine-orm']);
    }

}