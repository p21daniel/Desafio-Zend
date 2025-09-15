<?php
namespace Blog\Factory;

use Blog\Controller\ListController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        // Aqui, $controllerManager é o ControllerManager
        $serviceLocator = $controllerManager->getServiceLocator();

        if (!$serviceLocator->has('Blog\Service\PostServiceInterface')) {
            throw new \Exception('PostServiceInterface não encontrado no ServiceManager');
        }

        $postService = $serviceLocator->get('Blog\Service\PostServiceInterface');

        return new ListController($postService);
    }
}
