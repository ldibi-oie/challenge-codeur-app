<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
   
    #[Route("/" , name: "app_admin")]
    public function index(): Response
    {
      return $this->render('base.html.twig');
    }
}