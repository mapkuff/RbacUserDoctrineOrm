<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 09/03/2016
 * Time: 2:06 AM
 */

namespace RbacUserDoctrineOrm\Factory;


use Interop\Container\ContainerInterface;
use RbacUserDoctrineOrm\Authentication\Storage\ZfcUserDoctrineStorageDelegator;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

class ZfcUserDoctrineStorageDelegatorFactory implements  DelegatorFactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        $em = $container->get('Doctrine\ORM\EntityManager');
        $moduleOptions = $container->get('zfcuser_module_options');
        return new ZfcUserDoctrineStorageDelegator($callback(), $em, $moduleOptions );
    }

}