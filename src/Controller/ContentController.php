<?php

namespace App\Controller;

use App\Entity\Content;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentController extends AbstractController
{
    public function index(Request $request,$slug)
    {
        $content = $this->getDoctrine()->getManager()->find(Content::class,1);

        return $this->render('theme/default/content.html.twig',['content' => $content]);
    }
}
