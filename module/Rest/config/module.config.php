<?php

use Rest\Model\RestUserTable;
use Rest\Model\UserTable;

return array(
    'controllers' => array(
        'invokables' => array(
            'Index' => 'Rest\Controller\IndexController',
            'User' => 'Rest\Controller\UserController',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'RestUser' =>  function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $table     = new RestUserTable($dbAdapter);
                return $table;
            },
            'RestUserService' => 'Rest\Service\RestUserService',
            'User' =>  function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $table     = new UserTable($dbAdapter);
                return $table;
            },
            'UserService' => 'Rest\Service\UserService',
        ),
    ),

    'router' => array(
        'routes' => array(
            'rest' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/rest/:controller[/:id]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                ),
            ),
            'home' => array(
                'type'  => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'doctype' => 'HTML5',
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'not_found_template'       => 'error/404',
        'exception_template' => 'error/index',

        'template_map' => array(
            'error/index'    => __DIR__ . '/../view/rest/error/index.phtml',
            'error/404'     => __DIR__ . '/../view/rest/error/404.phtml',
        ),
        'template_path_stack' => array(
            'rest' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);