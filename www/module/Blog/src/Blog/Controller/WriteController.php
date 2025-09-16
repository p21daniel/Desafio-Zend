<?php

namespace Blog\Controller;

use Application\Repository\InterfaceRepo;
use Zend\Form\FormInterface;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class WriteController
 * @package Blog\Controller
 */
class WriteController extends AbstractActionController
{
    /**
     * @var InterfaceRepo
     */
    protected $postService;

    /**
     * @var FormInterface
     */
    protected $postForm;

    /**
     * WriteController constructor.
     * @param InterfaceRepo $postService
     * @param FormInterface $postForm
     */
    public function __construct(
        InterfaceRepo $postService,
        FormInterface $postForm
    ) {
        $this->postService = $postService;
        $this->postForm    = $postForm;
    }

    /**
     * @return Response|ViewModel
     */
    public function addAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->postForm->setData($request->getPost());

            if ($this->postForm->isValid()) {
                if (($this->postForm->getData()->getTitle() === '') || $this->postForm->getData()->getText() === '') {
                    return $this->redirect()->toRoute('blog');
                }
                try {
                    $this->postService->savePost($this->postForm->getData());
                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->postForm
        ));
    }

    /**
     * @return Response|ViewModel
     */
    public function editAction()
    {
        $request = $this->getRequest();
        $post = $this->postService->findPost($this->params('id'));

        $this->postForm->bind($post);

        if ($request->isPost()) {
            $this->postForm->setData($request->getPost());

            if ($this->postForm->isValid()) {
                if (($this->postForm->getData()->getTitle() === '') || $this->postForm->getData()->getText() === '') {
                    return $this->redirect()->toRoute('blog');
                }
                try {
                    $this->postService->savePost($this->postForm->getData());

                    return $this->redirect()->toRoute('blog');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->postForm
        ));
    }
}