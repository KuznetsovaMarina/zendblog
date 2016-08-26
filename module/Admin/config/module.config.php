<?php

return array(
    
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'category' => 'Admin\Controller\CategoryController',
            'article' => 'Admin\Controller\ArticleController',
        ),
    ),
       
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin/',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                
                'may_terminate' => true,
                
                'child_routes' => array(
                    'category' => array(
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route' => 'category/[:action/][:id/]',
                            'defaults' => array(
                                'controller' => 'category',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    
                    'article' => array(
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => array(
                            'route' => 'article/[:action/][:id/]',
                            'defaults' => array(
                                'controller' => 'article',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            //'admin_navigation' => 'Admin\Lib\AdminNavigationFactory',
        ),
    ),
    
    'navigation' => array(
        
        /*'default' => array(
            array(
                'label' => 'Главная',
                'route' => 'home',
            ),
        ),*/
        
        'default' => array(
            array(
                'label' => 'Панель управления сайтом',
                'route' => 'admin',
                'action' => 'index',
                'resource' => 'Admin\Controller\Index',
                
                'pages' => array(
                    array(
                        'label' => 'Статьи',
                        'route' => 'admin/article',
                        'action' => 'index',
                    ),
                    
                    array(
                        'label' => 'Категории',
                        'route' => 'admin/category',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
        /*
        'admin_navigation' => array(
            array(
                'label' => 'Панель управления сайтом',
                'route' => 'admin',
                'action' => 'index',
                'resource' => 'Admin\Controller\Index',
                
                'pages' => array(
                    array(
                        'label' => 'Статьи',
                        'route' => 'admin/article',
                        'action' => 'index',
                    ),
                    
                    array(
                        'label' => 'Категории',
                        'route' => 'admin/category',
                        'action' => 'index',
                    ),
                ),
            ),
        ),*/
        
    ),
    
    
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        
        'template_map' => array(
            'pagination_control' => __DIR__.'/../view/layout/pagination_control.phtml',
        ),
    ),
    
);


