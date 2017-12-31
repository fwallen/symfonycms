<?php

namespace App\Tests;

use App\Entity\Permission;
use App\Entity\User;
use App\Entity\UserGroup;
use Faker\Generator;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupsTest extends WebTestCase
{
    use SetUpTearDownTrait;

    protected function createUser()
    {
        $user = new User();
        $user->setUsername($this->faker->userName)
            ->setEmail($this->faker->email)
            ->setPassword('test')
        ;
        $this->em->persist($user);
        $this->em->flush();

        return $user;

    }

    protected function createGroupAndOwner()
    {
        $user = $this->createUser();
        $group = new UserGroup();
        $group->setName($this->faker->colorName)
            ->setDescription($this->faker->sentence);

        $group->setOwner($user);
        $this->em->persist($group);
        $this->em->flush();

        return $group;
    }

    public function testAssignUserToNewUserGroup()
    {

        /** @var UserGroup $group */
        $group = $this->createGroupAndOwner();

        /** @var User $newUser */
        $newUser =$this->createUser();

        $group->addUser($newUser);
        $this->em->flush();

        $freshGroup = $this->em->getRepository(UserGroup::class)->find($group->getId());
        $this->assertTrue($freshGroup->getUsers()->contains($newUser));

    }

    public function testAddPermissionsToGroup()
    {
        $group = $this->createGroupAndOwner();

        $permission       = $this->em->getRepository(Permission::class)->findOneByName('CONTENT_VIEW');
        $this->em->merge($permission);
        $group->addPermission($permission);
        $this->em->flush();

        $this->assertTrue($this->em->getRepository(UserGroup::class)->hasPermission($group,'CONTENT_VIEW'));
    }

    public function testRemovePermissionFromGroup()
    {
        $group = $this->createGroupAndOwner();
        $permission       = $this->em->getRepository(Permission::class)->findOneByName('CONTENT_VIEW');
        $this->em->merge($permission);
        $group->addPermission($permission);
        $this->em->flush();

        $group->removePermission($permission);
        $this->em->flush();

        $this->assertFalse($this->em->getRepository(UserGroup::class)->hasPermission($group,'CONTENT_VIEW'));

    }
}
