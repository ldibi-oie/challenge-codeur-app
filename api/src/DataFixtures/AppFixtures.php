<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Company;
<<<<<<< HEAD
use App\Entity\Freelance;
use App\Entity\MediaObject;
use App\Entity\Offer;
use App\Entity\Subscription;
use App\Entity\Freelance;
=======
use App\Entity\Offer;
use App\Entity\Subcription;
use App\Entity\Freelance;
use App\Entity\Keyword;
>>>>>>> 49171233 (adding new fixtures)
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Plan;
use App\Entity\Category;
use App\Entity\Keyword;
use App\Entity\Comment;
use Faker\Factory;
use Faker\Provider\DateTime;
use function mt_rand;
use function set_include_path;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->faker = Factory::create('FR-fr');
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $freelancers = [];
        $companies = [];


        $user = new User();
        $user->setEmail('admin@admin.fr');
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, "password_1234"));
        $manager->persist($user);

        $manager->flush();


        /* create plans fixtures */

        // company subscription plans
        $plan = new Plan();
        $plan->setName('Monthly');
        $plan->setSlug('Monthly');
        $plan->setPrice(3900);
        $plan->setStripeId('price_1MTlBKAor24SfpgrohcSJ6S6');
        $plan->setPaymentLink('https://buy.stripe.com/test_8wMdSH1Ceg30am4dQQ');
        $manager->persist($plan);
        $manager->flush();
<<<<<<< HEAD

        $plan = new Plan();
        $plan->setName('SixMonths');
        $plan->setSlug('SixMonths');
        $plan->setPrice(19900);
        $plan->setStripeId('price_1MY3RaAor24SfpgrRdc4KpYJ');
        $plan->setPaymentLink('https://buy.stripe.com/test_00gg0PcgS042gKseUW');
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

=======
>>>>>>> 49171233 (adding new fixtures)
        //fixtures 
        for($i = 0; $i < 10; $i++) 
        {
            $company = new Company();
            $company->setName("test".$i);
            $company->setSiretnumber(123456789);
            $company->setRole(["ROLE_COMPANY"]);
            $company->setEmail("boubacar1".$i."@live.fr");
            $company->setAddress("2 rue de symfony, 75018 php");
            
            $freelance = new Freelance();
            $freelance->setName("test".$i);
            $freelance->setSurname("last".$i);
            $freelance->setSiretnumber(123456789);
            $freelance->setRole(["ROLE_FREELANCE"]);
            $freelance->setBirthday("5/2/2022");
            $freelance->setEmail("freelane".$i."@gmail.com");
            $freelance->setIsverified(false);
            $freelance->setPassword("234678G");
            $freelance->setFreelancetypes(["dev","graphisme","video"]);
            $freelance->setCvlink("www.google.fr");

            $offer = new Offer();
            $offer->setCompany($company);
            $offer->setTitle("offre".$i);
            $offer->setDescription("description de l'offre".$i);
            $freelance->addOffer($offer);

            $keyword = new Keyword();
            $keyword->setName("dev".$i);
            $keyword->setOffer($offer);
            $company->setOfferlist([$offer]);
            $offer->addKeyword($keyword);
            $freelance->addKeyword($keyword);

            $subcription = new Subscription();
            $subcription->setSubcriptiontype("annuel");
            $company->setSubscription($subcription);

            $manager->persist($keyword);
            $manager->persist($offer);
            $manager->persist($company);
            $manager->persist($subcription);
            $manager->persist($freelance);
        }
        $manager->flush();
    }
}
