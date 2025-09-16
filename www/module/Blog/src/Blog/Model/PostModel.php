<?php

namespace Blog\Model;

use Application\Model\AbstractModel;
use Blog\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

class PostModel extends AbstractModel
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, Post::class);
    }
}