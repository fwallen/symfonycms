<?php

namespace App\Tests;

use App\Entity\Content;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContentEntityTest extends WebTestCase
{
    protected $client;
    protected $em;
    protected $faker;

    public function setUp()
    {
        $this->client = $this->createClient( [ 'environment' => 'test' ] );
        $this->client->disableReboot();
        $this->em = $this->client->getContainer()->get( 'doctrine.orm.entity_manager' );
        $this->faker = \Faker\Factory::create();
        $this->em->beginTransaction();
    }

    public function tearDown()
    {
        $this->em->rollback();
    }

    public function testCreateContentEntityAndRepository()
    {
        $content = new Content();
        $path = $this->faker->word;
        $content->setStatus('TEST')
            ->setIsPublished(true)
            ->setTitle($this->faker->sentence)
            ->setSummary($this->faker->paragraph)
            ->setBody($this->faker->paragraph)
            ->setPath($path)
        ;

        //Test saving to DB
        $this->em->persist($content);
        $this->em->flush();

        $this->assertNotNull($content->getCreatedAt());

        $title = $this->faker->word;
        $content->setTitle( $title );
        $this->em->flush();

        $this->assertNotNull($content->getUpdatedAt());

        //Testing finding content using a slug
        $newContent = $this->em->getRepository(Content::class)
            ->findOneByReference($path);

        $this->assertEquals($title,$newContent->getTitle());

        $sameContent = $this->em->getRepository(Content::class)
            ->findOneByReference($newContent->getId());
        $this->assertEquals($newContent,$sameContent);
    }
}
