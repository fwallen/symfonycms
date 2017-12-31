<?php


namespace App\DataFixtures;


use App\Entity\User;
use App\Entity\UserGroup;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

class UserGroupFixture extends ContainerAwareFixture
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        parent::load($manager);

        $owner = $manager->find(User::class,1);

        $count = 3;
        while($count) {
            $group = new UserGroup();
            $group->setDescription($this->faker->sentence)
                ->setName($this->faker->colorName)
                ->setOwner($owner);
            $manager->persist($group);
            $count--;
        }

        $manager->flush();
    }


}