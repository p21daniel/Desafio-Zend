<?php

use Doctrine\DBAL\Driver\PDOMySql\Driver as PDOMySqlDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOMySqlDriver::class,
                'params' => [
                    'host'     => 'mysql',
                    'user'     => 'root',
                    'password' => 'root',
                    'dbname'   => 'blog',
                    'charset'  => 'utf8',
                ],
            ],
        ],
        'driver' => [
            'blog_entities' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => ['/usr/share/nginx/html/module/Blog/src/Blog/Entity'],
            ],
            'orm_default' => [
                'drivers' => [
                    'Blog\Entity' => 'blog_entities',
                ],
            ],
        ],
    ],
];
