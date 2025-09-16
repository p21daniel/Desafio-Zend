<?php

namespace Application\Model;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractModel
{
    /** @var EntityManagerInterface */
    protected $em;

    /** @var string */
    protected $entityClass;

    public function __construct(EntityManagerInterface $em, $entityClass)
    {
        $this->em = $em;
        $this->entityClass = $entityClass;
    }

    protected function getRepository()
    {
        return $this->em->getRepository($this->entityClass);
    }

    public function find($id)
    {
        return $this->getRepository()->find($id);
    }

    public function findAll()
    {
        return $this->getRepository()->findAll();
    }

    public function save($entity, $flush = true)
    {
        $this->em->persist($entity);
        if ($flush) {
            $this->em->flush();
        }
        return $entity;
    }

    public function remove($entity, $flush = true)
    {
        $this->em->remove($entity);
        if ($flush) {
            $this->em->flush();
        }
    }
}
