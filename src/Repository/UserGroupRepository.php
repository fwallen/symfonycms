<?php

namespace App\Repository;

use App\Entity\UserGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserGroup::class);
    }

    public function hasPermission(UserGroup $userGroup,$name) {

        $filteredPermissions = $userGroup
            ->getPermissions()
            ->filter(function($permission) use($name) {
                return $permission->getName() === $name;
            });

        return $filteredPermissions->count() > 0;
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('u')
            ->where('u.something = :value')->setParameter('value', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
