<?php

namespace Blog\Service;

use Blog\Entity\Post;
use Blog\Model\PostInterface;

class PostService implements PostServiceInterface
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * PostService constructor.
     * @param $postRepository
     * @param $objectManager
     */
    public function __construct($postRepository, $objectManager)
    {
        $this->postRepository = $postRepository;
        $this->objectManager = $objectManager;
    }

    /**
     * {@inheritDoc}
     */
    public function findAllPosts()
    {
        return $this->postRepository->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findPost($id)
    {
        return $this->postRepository->find($id);
    }

    /**
     * @inheritDoc
     */
    public function savePost($postForm)
    {
        $id = '';

        if (method_exists($postForm, 'getId')) {
            $id = $postForm->getId();
        }

        if ($id === '' || $id === null) {
            $post = new Post();
            $post->setText($postForm->getText());
            $post->setTitle($postForm->getTitle());

            $this->objectManager->persist($post);
            $this->objectManager->flush();
        } else {
            $post = $this->objectManager->find('Blog\Entity\Post', $id);

            $post->setTitle($postForm->getTitle());
            $post->setText($postForm->getText());

            $this->objectManager->flush();
        }
    }

    /**
     * @inheritDoc
     */
    public function deletePost($postForm)
    {
        $id = $postForm->getId();
        $post = $this->objectManager->find('Blog\Entity\Post', $id);

        $this->objectManager->remove($post);
        $this->objectManager->flush();
    }
}