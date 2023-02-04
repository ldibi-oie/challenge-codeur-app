<?php 
// RegistrationController.php
namespace App\Controller;


use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends AbstractController
{
    private $verifyEmailHelper;
    private $mailer;
    
    public function __construct(VerifyEmailHelperInterface $helper, MailerInterface $mailer)
    {
        $this->verifyEmailHelper = $helper;
        $this->mailer = $mailer;
    }
    
    #[Route('/register2', name: 'register-user')]
    public function register(): Response
    {
        $user = new User();
    
        // handle the user registration form and persist the new user...
    
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
                'registration_confirmation_route',
                $user->getId(),
                $user->getEmail()
            );
        
        $email = (new TemplatedEmail())
        ->from('myproject.codeur@gmail.com')
        ->to($user->getEmail())
        ->htmlTemplate('registration/confirmation_email.html.twig')
        ->context(['signedUrl' => $signatureComponents->getSignedUrl()]);
        
        $this->mailer->send($email);
    
        // generate and return a response for the browser
        return new Response("Votre mail de confirmation vous a ete envoye ! regarder votre mail", 200);
    }
}