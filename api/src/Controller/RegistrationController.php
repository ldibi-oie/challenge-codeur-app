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

    #[Route("/register", name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $signatureComponents = $this->verifyEmailHelper->generateSignature(
                'app_verify_email',
                $user->getId(),
                $user->getEmail(),
                ['id' => $user->getId()]
            );
        
            $email = new TemplatedEmail();
            $email->from(new Address('myproject.codeur@gmail.com', 'Codeur bot'));
            $email->to($user->getEmail());
            $email->subject("Confirmation de votre email!");
            $email->htmlTemplate('registration/confirmation_email.html.twig');
            $email->context([
                'signedUrl' => $signatureComponents->getSignedUrl(),
                'expiresAtMessageKey' => $signatureComponents->getExpirationMessageKey(),
                'expiresAtMessageData' => $signatureComponents->getExpirationMessageData()
            ]);
            
            $this->mailer->send($email);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
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
        return $this->json([
            "user" => $request->getContent() ? $request->getContent() : null
        ]);
    }

    // public function onLoginSuccess(AuthenticationSuccessEvent $event): void
    // {
    //     $user = $event->getUser();
    //     $payload = $event->getData();
    //     if (!$user instanceof User) {
    //         return;
    //     }
    //     // Add information to user payload
    //     // $payload['user'] = [
    //     //     ...
    //     // ];
    //     var_dump($event->setData($payload));
    // }

}
