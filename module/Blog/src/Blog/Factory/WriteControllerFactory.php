<?php

namespace Blog\Factory;

use Blog\Controller\WriteController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class WriteControllerFactory
 * @package Blog\Factory
 */
class WriteControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $postService = $realServiceLocator->get('Blog\Service\PostServiceInterface');
        $postInsertForm = $realServiceLocator->get('FormElementManager')->get('Blog\Form\PostForm');

        return new WriteController(
            $postService,
            $postInsertForm
        );
    }
}