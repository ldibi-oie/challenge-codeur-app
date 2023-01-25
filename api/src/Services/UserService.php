<?php

namespace App\Services;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;

class UserService
{

    /** @var  TokenStorageInterface */
    private $tokenStorage;
    private $security;
    /**
     * @param TokenStorageInterface  $storage
     */
    public function __construct(
        TokenStorageInterface $storage,
        Security $security
    )
    {
        $this->tokenStorage = $storage;
        $this->security = $security;
    }

    // #[Route("/api/login_check", name: 'login_check' , methods:['POST'])]
    // public function getCurrentUser(Request $request)
    // {

    //     $token0 = $request->getHeaders();
    //     $token = $this->tokenStorage->getToken();
    //     if ($token instanceof TokenInterface) {
    //         /** @var User  $user */
    //         $user = $token->getUser();
    //         return $user;

    //     } else {
    //         return "null";
    //     }

    //     return $request->getContent();
    // }
}