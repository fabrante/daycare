<?php
// module/Album/Module.php
namespace Rest;

use Zend\Mvc\MvcEvent;


class Module
{
    public function onBootstrap($e) {
        $em  = $e->getApplication()->getEventManager()->getSharedManager();
        $sm  = $e->getApplication()->getServiceManager();


        $em->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function($e) use ($sm) {
            $strategy = $sm->get('ViewJsonStrategy');
            $view     = $sm->get('ViewManager')->getView();
            $strategy->attach($view->getEventManager());
        });

    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/config/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}