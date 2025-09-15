<?php
namespace Blog\Service;

use Blog\Entity\Post;
use Blog\Model\PostInterface;
use Doctrine\Entity;

interface PostServiceInterface
{
    /**
     * Should return a set of all blog posts that we can iterate over. Single entries of the array are supposed to be
     * implementing \Blog\Model\PostInterface
     *
     * @return array
     */
    public function findAllPosts();

    /**
     * Should return a single blog post
     *
     * @param  int $id Identifier of the Post that should be returned
     * @return Post
     */
    public function findPost($id);

    /**
     * Should save a given implementation of the Post and return it. If it is an existing Post the Post
     * should be updated, if it's a new Post it should be created.
     *
     * @param  $postForm
     *
     */
    public function savePost($postForm);

    /**
     * Should delete a given implementation of the Post and return true if the deletion has been
     * successful or false if not.
     *
     * @param  PostInterface $post
     * @return bool
     */
    public function deletePost($postForm);
}