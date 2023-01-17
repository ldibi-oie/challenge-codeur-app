<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
class HomeController extends AbstractController
{
   
  /**
    * @Route("/")
    */
    public function index(): Response
    {
      return $this->render('base.html.twig');
    }

  /**
    * @Route("/app/{slug?}", name="app", requirements={"slug"=".+"})")
    */
    public function app(): Response
    {
      return $this->render('app.html.twig');
    }
}