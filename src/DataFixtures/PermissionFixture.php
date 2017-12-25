<?php


namespace App\DataFixtures;


use App\Entity\Permission;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

class PermissionFixture extends ContainerAwareFixture
{
    protected $permissions = [
        'CONTENT_VIEW',
        'CONTENT_EDIT',
        'CONTENT_PUBLISH',
        'CONTENT_CREATE'
    ];

    public function load(ObjectManager $manager)
    {
        foreach($this->permissions as $permission)
        {
            $permission = new Permission();
            $permission->setName($permission);
            $manager->persist($permission);
        }

        $manager->flush();
    }

}