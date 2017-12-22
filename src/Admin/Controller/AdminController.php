<?php


namespace App\Admin\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return $this->render('admin/admin.html.twig');
    }
}