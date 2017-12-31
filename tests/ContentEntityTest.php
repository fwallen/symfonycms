<?php

namespace App\Tests;

use App\Entity\Content;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContentEntityTest extends WebTestCase
{
    use SetUpTearDownTrait;

    public function testCreateContent()
    {
        $content = new Content();
        $content->setStatus('TEST')
            ->setIsPublished(true)
            ->setTitle($this->faker->sentence)
            ->setSummary($this->faker->paragraph)
            ->setBody($this->faker->paragraph)
        ;

        $this->em->persist($content);
        $this->em->flush();

        $this->assertNotNull($content->getCreatedAt());

        $content->setTitle($this->faker->word);
        $this->em->flush();

        $this->assertNotNull($content->getUpdatedAt());
    }
}
