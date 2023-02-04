<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Plan;
use App\Entity\Category;

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

        $user1 = new User();
        $user1->setEmail('admin@admin.fr');
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setPassword($this->userPasswordHasher->hashPassword($user1, "password"));
        $manager->persist($user1);

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
        $company->setSiretnumber(339431181);
        $company->setUser($user); // NEW PROPERTY
        $company->setAddress('94 rue de la paix, 75000 Paris');
        $manager->persist($company);
        $manager->flush();

        $company = new Company();
        $company->setName('WhatBig');
        $company->setSiretnumber(339431181);
        $company->setUser($user1); // NEW PROPERTY
        $company->setAddress('234 rue de la paix, 75002 Paris');
        $manager->persist($company);
        $manager->flush();

        // $company = new Company();
        // $company->setName('ClayDrive');
        // $company->setSiretnumber(339431181);
        // $company->setAddress('23 rue de la paix, 75000 Paris');
        // $manager->persist($company);
        // $manager->flush();


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

        // LES CATEGORIES
        $category = new Category();
        $category->setName('');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Développeur WordPress');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Développeur web');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Développeur mobile');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Développeur full stack');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Administrateur réseau');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Consultant SEO');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Graphiste');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Monteur vidéo');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Rédacteur web');
        $manager->persist($category);
        $manager->flush();
        
        
        $category = new Category();
        $category->setName('Correcteur');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Traducteur');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Community manager');
        $manager->persist($category);
        $manager->flush();
        

        $category = new Category();
        $category->setName('Assistant virtuel');
        $manager->persist($category);
        $manager->flush();

        $manager->flush();

    }
}
