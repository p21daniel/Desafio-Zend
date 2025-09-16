<?php

namespace Blog\Controller;

use Application\Repository\InterfaceRepo;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class DeleteController
 * @package Blog\Controller
 */
class DeleteController extends AbstractActionController
{
    /**
     * @var InterfaceRepo
     */
    protected $postService;

    /**
     * DeleteController constructor.
     * @param InterfaceRepo $postService
     */
    public function __construct(InterfaceRepo $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return Response|ViewModel
     */
    public function deleteAction()
    {
        try {
            $post = $this->postService->findPost($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('blog');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'Não');

            if ($del === 'Sim') {
                $this->postService->deletePost($post);
            }

            return $this->redirect()->toRoute('blog');
        }

        return new ViewModel(array(
            'post' => $post
        ));
    }
}