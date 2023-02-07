<?php

namespace App\EventListener;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
class LoginSuccessListener
{

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

        $event->setData($payload);
    }
}