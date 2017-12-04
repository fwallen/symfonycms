<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 * @ORM\Table(name="content_page")
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=2048)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $body;
}
