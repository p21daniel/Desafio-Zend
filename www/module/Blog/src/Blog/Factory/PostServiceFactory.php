<?php

namespace Blog\Factory;

use Blog\Service\PostService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PostServiceFactory
 * @package Blog\Factory
 */
class PostServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $postRepository = $objectManager->getRepository('Blog\Entity\Post');

        return new PostService
        (
            $postRepository,
            $objectManager
        );
    }
}