<?php

return [
    'service_manager' => [
        'factories' => [
            Blog\Service\PostServiceInterface::class => Blog\Factory\PostServiceFactory::class,
        ],
    ],

    'controllers' => [
        'factories' => [
            'Blog\Controller\List'   => Blog\Factory\ListControllerFactory::class,
            'Blog\Controller\Write'  => Blog\Factory\WriteControllerFactory::class,
            'Blog\Controller\Delete' => Blog\Factory\DeleteControllerFactory::class,
        ],
    ],

    'router' => [
        'routes' => [
            'blog' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/blog',
                    'defaults' => [
                        'controller' => 'Blog\Controller\List',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'detail' => [
                        'type' => 'segment',
                        'options' => [
                            'route'       => '/:id',
                            'defaults'    => ['action' => 'detail'],
                            'constraints' => ['id' => '[1-9]\d*'],
                        ],
                    ],
                    'add' => [
                        'type' => 'literal',
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'controller' => 'Blog\Controller\Write',
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'segment',
                        'options' => [
                            'route'       => '/edit/:id',
                            'defaults'    => [
                                'controller' => 'Blog\Controller\Write',
                                'action'     => 'edit',
                            ],
                            'constraints' => ['id' => '\d+'],
                        ],
                    ],
                    'delete' => [
                        'type' => 'segment',
                        'options' => [
                            'route'       => '/delete/:id',
                            'defaults'    => [
                                'controller' => 'Blog\Controller\Delete',
                                'action'     => 'delete',
                            ],
                            'constraints' => ['id' => '\d+'],
                        ],
                    ],
                    'pdfAll' => [
                        'type' => 'literal',
                        'options' => [
                            'route'    => '/pdfAll',
                            'defaults' => [
                                'controller' => 'Blog\Controller\List',
                                'action'     => 'pdfAll',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
        ],
    ],
];
