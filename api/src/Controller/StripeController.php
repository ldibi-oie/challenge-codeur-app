<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class StripeController extends AbstractController
{
    #[Route('/stripe/has_active_sub/{id}', name: 'app_webhook_stripe', methods: ['GET'])]
    public function getActiveSubscription(User $user): Response
    {
		$activeSub = $doctrine->getRepository(Subscription::class)->findActiveSub($user->getId());

        http_response_code(200);

		$response = new Response('success');
        $response->headers->set('Content-Type', 'application/json');

        if (!$activeSub) {
            $response->setContent(json_encode(array('hasActiveSub' => true)));
        } else {
            $response->setContent(json_encode(array('hasActiveSub' => false)));
        }

        return $response;
    }
    #[Route('/stripe', name: 'app_stripe')]
    public function index(): Response
    {
        return $this->render('stripe/index.html.twig', [
            'controller_name' => 'StripeController',
        ]);
    }

}
