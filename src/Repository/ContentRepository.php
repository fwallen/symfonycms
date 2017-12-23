<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ContentRepository extends ServiceEntityRepository
{
    public function __construct( RegistryInterface $registry )
    {
        parent::__construct( $registry, Content::class );
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function getfindByReferenceQuery($ref)
    {
        $queryBuilder = $this->createQueryBuilder('content');
        return $queryBuilder
            ->where($queryBuilder->expr()->orX(
                $queryBuilder->expr()->eq('content.id',':refId'),
                $queryBuilder->expr()->eq('content.path',':refPath')
            ))
            ->setParameters([
                'refId'=>$ref,
                'refPath' => $ref,
            ]);
    }

    /**
     * @param $ref
     * @return mixed
     */
    public function findByReference( $ref )
    {
        return $this->getfindByReferenceQuery($ref)->getQuery()->getResult();
    }

    /**
     * @param $ref
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByReference($ref)
    {

        return $this->getfindByReferenceQuery($ref)->setMaxResults(1)->getQuery()->getSingleResult();
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
