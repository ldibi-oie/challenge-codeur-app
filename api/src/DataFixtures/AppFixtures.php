<?php

namespace App\DataFixtures;

use App\Entity\User;
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

        /* create plans fixtures */

        $plan = new Plan();
        $plan->setName('Monthly');
        $plan->setSlug('Monthly');
        $plan->setPrice(39);
        $plan->setStripeId('price_1MTlBKAor24SfpgrohcSJ6S6');
        $plan->setPaymentLink('https://buy.stripe.com/test_8wMdSH1Ceg30am4dQQ');
        $manager->persist($plan);

        $manager->flush();

        $plan = new Plan();
        $plan->setName('Yearly');
        $plan->setSlug('Yearly');
        $plan->setPrice(390);
        $plan->setStripeId('price_1MTlclAor24SfpgrZynCfsYo');
        $plan->setPaymentLink('https://buy.stripe.com/test_8wM15Vgx818665O001');
        $manager->persist($plan);

        $manager->flush();

    }
}
