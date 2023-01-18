<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class RegisterController extends AbstractController
{
  private $userPasswordHasher;
    
  public function __construct(UserPasswordHasherInterface $userPasswordHasher)
  {
      $this->userPasswordHasher = $userPasswordHasher;
  }
 
  #[Route('/register', name: 'register' , methods: ['POST'])]
  public function register(Request $request): Response
  {
      // $user = new User();
      // $user->setEmail('admin@admin.fr');
      // $user->setRoles(["ROLE_ADMIN"]);
      // $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
      // $manager->persist($user);

      // $manager->flush();
      $data = new JsonResponse($request->getContent(), true);
    return $data;
  }

  /**
   * @Route("/verify", name="app_verify_email")
   */
  public function verifyUserEmail(): Response
  {
    return $this->render('base.html.twig');
  }

}