<?php


namespace App\DataFixtures;


use App\Entity\Content;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

class ContentFixture extends ContainerAwareFixture
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        parent::load($manager);

        $count = 3;
        while($count){
            $content = new Content();
            $content->setTitle($this->faker->unique()->words(3,true))
                ->setBody($this->faker->paragraph)
                ->setSummary($this->faker->sentence)
                ->setPath($this->faker->slug)
                ->setStatus($this->faker->uuid)
                ->setIsPublished(true);
            $manager->persist($content);
            $count--;
        }

        $manager->flush();
    }

}