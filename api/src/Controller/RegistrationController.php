<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Services\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class RegistrationController extends AbstractController
{
    private $verifyEmailHelper;
    private $mailer;
    
    public function __construct(VerifyEmailHelperInterface $helper, MailerInterface $mailer)
    {
        $this->verifyEmailHelper = $helper;
        $this->mailer = $mailer;
    }

    // SEND EMAIL FOR RESET PASSWORD
    #[Route("/send/reset/password", name: 'send_reset_password')]
    public function sendResetPassword(Request $request) : Response
    {
        $obj = json_decode($request->getContent());
            $signatureComponents = $this->verifyEmailHelper->generateSignature(
                'verify_reset_password',
                $obj->id,
                $obj->email,
                ['id' => $obj->id]
            );
        
            $email = new TemplatedEmail();
            $email->from(new Address('myproject.codeur@gmail.com', 'Codeur bot'));
            $email->to($obj->email);
            $email->subject("Reinitialiser le mot de passe !");
            $email->htmlTemplate('resetPassword.html.twig');
            $email->context([
                'signedUrl' => $signatureComponents->getSignedUrl(),
                'expiresAtMessageKey' => $signatureComponents->getExpirationMessageKey(),
                'expiresAtMessageData' => $signatureComponents->getExpirationMessageData()
            ]);
            
            $this->mailer->send($email);

        return new Response("true", Response::HTTP_OK);
    }


    // VERIFY LINK IN EMAIL FOR RESET PASSWORD
    #[Route("/verify/reset/password", name: 'verify_reset_password')]
    public function resetPassword(Request $request , UserRepository $userRepository , EntityManagerInterface $entityManager) : Response
    {
        $id = $request->get('id'); // retrieve the user id from the url

       // Verify the user id exists and is not null
       if(null === $id) {
           return $this->redirect($this->getParameter('vuejs.home'));
       }

       $user = $userRepository->find($id);

       // Ensure the user exists in persistence
       if(null === $user) {
           return $this->redirect($this->getParameter('vuejs.home'));
       }

        // Do not get the User's Id or Email Address from the Request object
        try {
            $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('verify_email_error', $e->getReason());

            return $this->redirect($this->getParameter('vuejs.404'));
        }

        $data = [
            'id' => $user->getId(),
        ];

        // Mark your user as verified. e.g. switch a User::verified property to true
        $redirect = new RedirectResponse(
            $this->getParameter('vuejs.resetPassword'),
            RedirectResponse::HTTP_FOUND,
            $data
        );
        return $redirect;
    }

    #[Route("/register", name: 'app_register')]
    public function register(Request $request) : Response
    {
        $obj = json_decode($request->getContent());
            $signatureComponents = $this->verifyEmailHelper->generateSignature(
                'app_verify_email',
                $obj->id,
                $obj->email,
                ['id' => $obj->id]
            );
        
            $email = new TemplatedEmail();
            $email->from(new Address('myproject.codeur@gmail.com', 'Codeur bot'));
            $email->to($obj->email);
            $email->subject("Confirmation de votre email!");
            $email->htmlTemplate('registration/confirmation_email.html.twig');
            $email->context([
                'signedUrl' => $signatureComponents->getSignedUrl(),
                'expiresAtMessageKey' => $signatureComponents->getExpirationMessageKey(),
                'expiresAtMessageData' => $signatureComponents->getExpirationMessageData()
            ]);
            
            $this->mailer->send($email);

        return new Response("true", Response::HTTP_OK);
    }

    #[Route("/verify/email", name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository , EntityManagerInterface $entityManager): Response
    {
        $id = $request->get('id'); // retrieve the user id from the url

       // Verify the user id exists and is not null
       if(null === $id) {
           return $this->redirect($this->getParameter('vuejs.home'));
       }

       $user = $userRepository->find($id);

       // Ensure the user exists in persistence
       if(null === $user) {
           return $this->redirect($this->getParameter('vuejs.home'));
       }

        // Do not get the User's Id or Email Address from the Request object
        try {
            $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());
            $user->setIsVerified(true);
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('verify_email_error', $e->getReason());

            return $this->redirect($this->getParameter('vuejs.404'));
        }

        // Mark your user as verified. e.g. switch a User::verified property to true

        $this->addFlash('success', 'Your e-mail address has been verified.');

        return $this->redirect($this->getParameter('vuejs.login'));
    }

    #[Route("/current", name: 'current_user')]
    public function getCurrentUser(Request $request) : Response
    {
        $user = $this->getUser();

        // return new Response('Well hi there '.$user. '. and request ' .$request->getContent());
        return $this->json([
            "user" => $request->getContent() ? $request->getContent() : null
        ]);
    }

    public function onLoginSuccess(AuthenticationSuccessEvent $event)
    {
        $user = $event->getUser();
        $payload = $event->getData();
        if (!$user instanceof User) {
            return;
        }
        // Add information to user payload
        $payload['user'] = [
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "isVerified" => $user->isIsVerified()
        ];
        
        return new JsonResponse([
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "isVerified" => $user->isIsVerified(),
        ]);
    }

}
