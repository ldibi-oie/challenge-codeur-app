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

}