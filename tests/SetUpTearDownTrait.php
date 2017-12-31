<?php


namespace App\Tests;


use Doctrine\ORM\EntityManager;
use Faker\Generator;

trait SetUpTearDownTrait
{


    protected $client;

    /**
     * @var EntityManager
     */
    protected $em;
    /**
     * @var Generator
     */
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
}