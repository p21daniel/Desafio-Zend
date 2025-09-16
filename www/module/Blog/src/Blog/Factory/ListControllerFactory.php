<?php
namespace Blog\Factory;

use Blog\Controller\ListController;
use Blog\Model\PostModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();

        if (!$serviceLocator->has(\Blog\Model\PostModel::class)) {
            throw new \RuntimeException('PostModel não está registrado no ServiceManager global!');
        }

        $postModel = $serviceLocator->get(\Blog\Model\PostModel::class);

        return new ListController($postModel);
    }
}
