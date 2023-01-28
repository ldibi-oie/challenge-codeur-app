<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Plan;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;
    
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager , ): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail('admin@admin.fr');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setEmail('test@test.fr');
        $user->setRoles(["USER_ROLE"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password"));
        $manager->persist($user);
        $manager->flush();

        /* create company fixtures */
        $company = new Company();
        $company->setName('Codeur Challenge');
        $company->setEmail('groupchallenge2022@gmail.com');
        $company->setSiretnumber(339431181);
        $company->setAddress('94 rue de la paix, 75000 Paris');
        $company->setRole(['ROLE_COMPANY']);
        $manager->persist($company);
        $manager->flush();

        $company = new Company();
        $company->setName('WhatBig');
        $company->setEmail('whatbig2022@gmail.com');
        $company->setSiretnumber(339431181);
        $company->setAddress('234 rue de la paix, 75002 Paris');
        $company->setRole(['ROLE_COMPANY']);
        $manager->persist($company);
        $manager->flush();

        $company = new Company();
        $company->setName('ClayDrive');
        $company->setEmail('claydrive2022@gmail.com');
        $company->setSiretnumber(339431181);
        $company->setAddress('23 rue de la paix, 75000 Paris');
        $company->setRole(['ROLE_COMPANY']);
        $manager->persist($company);
        $manager->flush();


        /* create plans fixtures */

        $plan = new Plan();
        $plan->setName('Monthly');
        $plan->setSlug('Monthly');
        $plan->setPrice(3900);
        $plan->setStripeId('price_1MTlBKAor24SfpgrohcSJ6S6');
        $plan->setPaymentLink('https://buy.stripe.com/test_8wMdSH1Ceg30am4dQQ');
        $manager->persist($plan);

        $manager->flush();

        $plan = new Plan();
        $plan->setName('Yearly');
        $plan->setSlug('Yearly');
        $plan->setPrice(39000);
        $plan->setStripeId('price_1MTlclAor24SfpgrZynCfsYo');
        $plan->setPaymentLink('https://buy.stripe.com/test_8wM15Vgx818665O001');
        $manager->persist($plan);

        $manager->flush();

    }
}
