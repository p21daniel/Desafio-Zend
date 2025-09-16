<?php

namespace Blog\Factory;

use Blog\Model\PostModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostModelFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // Pega o EntityManager do DoctrineModule
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');

        return new PostModel($em);
    }
}
