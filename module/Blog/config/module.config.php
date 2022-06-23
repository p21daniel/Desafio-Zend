<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Blog\Controller\List' => 'Blog\Factory\ListControllerFactory',
            'Blog\Controller\Write' => 'Blog\Factory\WriteControllerFactory',
            'Blog\Controller\Delete' => 'Blog\Factory\DeleteControllerFactory'
        )
    ),
    'router' => array(
        'routes' => array(
            'blog' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/blog',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\List',
                        'action' => 'index',
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:id',
                            'defaults' => array(
                                'action' => 'detail',
                            ),
                            'constraints' => array(
                                'id' => '[1-9]\d*'
                            )
                        )
                    ),
                    'add' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'controller' => 'Blog\Controller\Write',
                                'action' => 'add'
                            )
                        )
                    ),
                    'edit' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/edit/:id',
                            'defaults' => array(
                                'controller' => 'Blog\Controller\Write',
                                'action' => 'edit'
                            ),
                            'constrains' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                    'delete' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'controller' => 'Blog\Controller\Delete',
                                'action' => 'delete'
                            ),
                            'constraints' => array(
                                'id' => '\d+'
                            )
                        )
                    ),
                    'pdfAll' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/pdfAll',
                            'defaults' => array(
                                'controller' => 'Blog\Controller\List',
                                'action' => 'pdfAll'
                            ),
                        )
                    )
                ),
            )
        )
    ),
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array('module/Blog/src/Blog/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Blog\Entity' => 'application_entities'
                )
            )
        )
    )
);
