<?php

namespace App\DataFixtures;

use App\Entity\Offer;
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

        $user2 = new User();
        $user2->setEmail('company@test.fr');
        $user2->setRoles(["USER_ROLE"]);
        $user2->setPassword($this->userPasswordHasher->hashPassword($user2, "password"));
        $manager->persist($user2);
        $manager->flush();

        /* create company fixtures */
        $company = new Company();
        $company->setName('Codeur Challenge');
        $company->setSiretnumber(339431181);
        $company->setUser($user); // NEW PROPERTY
        $company->setAddress('94 rue de la paix, 75000 Paris');
        $user->setRoles(["FREELANCE"]);
        $manager->persist($company);
        $manager->flush();

        $company = new Company();
        $company->setName('WhatBig');
        $company->setSiretnumber(339481);
        $company->setUser($user2); // NEW PROPERTY
        $company->setAddress('234 rue de la paix, 75002 Paris');
        $user->setRoles(["COMPANY"]);

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
        

        $categoryR = new Category();
        $categoryR->setName('Développeur full stack');
        $manager->persist($categoryR);
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
        
        
        $category1 = new Category();
        $category1->setName('Correcteur');
        $manager->persist($category1);
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

        for ($i = 1; $i <= 15; $i++) {
            $offer = new Offer();
            $offer->setTitle('Projet '. $i .' - React node js pour la gestion des paiements de mon entreprise '. $i);
            $offer->setDescription('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.');
            $offer->setCategory($categoryR);
            $offer->setCompany($company);
            $offer->setPrice(500);
            $offer->setStatus("OPEN");
            $manager->persist($offer);
            $manager->flush();
        }

    }
}
