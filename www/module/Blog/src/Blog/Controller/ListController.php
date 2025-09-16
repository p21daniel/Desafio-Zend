<?php

namespace Blog\Controller;

use Application\Repository\InterfaceRepo;
use Blog\Pdf\Pdf;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class ListController
 * @package Blog\Controller
 */
class ListController extends AbstractActionController
{
    // FAZER REPOS, MODELS e AFINS
    /**
     * @var InterfaceRepo
     */
    protected $postService;

    /**
     * ListController constructor.
     * @param InterfaceRepo $postService
     */
    public function __construct(InterfaceRepo $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return array|ViewModel
     */
    public function indexAction()
    {
        $posts = $this->postService->findAllPosts();

        return new ViewModel(array(
            'posts' => $posts
        ));
    }

    /**
     * @return Response|ViewModel
     */
    public function detailAction()
    {
        $id = $this->params()->fromRoute('id');
        $post = $this->postService->findPost($id);

        if (!isset($post)) {
            return $this->redirect()->toRoute('blog');
        }

        return new ViewModel(array(
            'post' => $post
        ));
    }

    /**
     * Output findAll Doctrine in a PDF
     * This method uses FPDF component to display a PDF based in findAll return
     */
    public function pdfAllAction()
    {
        $posts = $this->postService->findAllPosts();
        $pdf = new Pdf();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);

        foreach ($posts as $key => $post) {
            $pdf->Cell(190,8,'Post '.$key+=1, 1,1,'C');
            $pdf->Ln(5);
            $pdf->Cell(190,10,utf8_decode($post->getTitle()), 0,1,'C');
            $pdf->Cell(190,10,utf8_decode($post->getText()), 0,1,'C');
            $pdf->Ln(10);
        }
        $pdf->AliasNbPages();
        $pdf->Output();
    }
}