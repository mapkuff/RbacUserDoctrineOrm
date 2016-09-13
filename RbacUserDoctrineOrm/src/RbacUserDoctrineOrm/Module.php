<?php

namespace RbacUserDoctrineOrm;

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\Mapping\Driver\XmlDriver;
use RbacUserDoctrineOrm\Options\ModuleOptions;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\Mvc\MvcEvent;

class Module implements  BootstrapListenerInterface, ConfigProviderInterface,
    AutoloaderProviderInterface, DependencyIndicatorInterface
{

    /**
     * Listen to the bootstrap event
     * @param MvcEvent|EventInterface $e
     * @return void
     */
    public function onBootstrap(EventInterface $e)
    {
        /* @var $e MvcEvent */
        $app     = $e->getApplication();
        $sm      = $app->getServiceManager();
        /* @var $moduleOptions ModuleOptions */
        $moduleOptions = $sm->get(ModuleOptions::class);

        if ($moduleOptions->isEnableDefaultUserEntity()){
            /* @var $chain MappingDriverChain */
            $chain   = $sm->get('doctrine.driver.orm_default');
            $chain->addDriver(new XmlDriver(__DIR__ . '/../../config/xml/doctrine/concrete-impl'), 'RbacUserDoctrineOrm\Domain\ConcreteImpl');
        }
    }


    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getModuleDependencies()
    {
        return [
            'ZfcUser',
            'ZfcUserDoctrineOrm',
            'DoctrineModule',
            'DoctrineORMModule',
            'ZfcRbac'
        ];
    }

}
