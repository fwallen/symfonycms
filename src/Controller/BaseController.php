<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    public function error(\Exception $e)
    {
        return $this->render('error_pages/error_page.html.twig',['error'=>$e]);
    }
}