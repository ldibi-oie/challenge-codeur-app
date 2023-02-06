<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use App\Entity\User;
use App\Entity\Company;
use App\Entity\Freelance;
use App\Entity\MediaObject;
use App\Entity\Offer;
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

        //freelance subscription plans
        $plan = new Plan();
        $plan->setName('FMonthly');
        $plan->setSlug('FMonthly');
        $plan->setPrice(999);
        $plan->setStripeId('price_1MY3bAAor24Sfpgr1VRs8lgJ');
        $plan->setPaymentLink('https://buy.stripe.com/test_14k8ynep05omeCkdQT');
        $manager->persist($plan);
        $manager->flush();

        $plan = new Plan();
        $plan->setName('FSixMonths');
        $plan->setSlug('FSixMonths');
        $plan->setPrice(4999);
        $plan->setStripeId('price_1MY3dMAor24Sfpgr4wlcE2Pp');
        $plan->setPaymentLink('https://buy.stripe.com/test_9AQg0PbcO5omcuc148');
        $manager->persist($plan);
        $manager->flush();

        $plan = new Plan();
        $plan->setName('FYearly');
        $plan->setSlug('FYearly');
        $plan->setPrice(9999);
        $plan->setStripeId('price_1MY3etAor24SfpgrdS3YtVin');
        $plan->setPaymentLink('https://buy.stripe.com/test_bIYcODcgS6sq65OdQV');
        $manager->persist($plan);
        $manager->flush();


        // les mots clés
        $keywords = ['', 'Développeur web', 'Développeur mobile', 'Développeur full stack',
        'Administrateur réseau', 'Développeur WordPress', 'Développeur Symfony', 'Développeur React',
        'Développeur Angular', 'Développeur Vue', 'Développeur Laravel', 'Développeur NodeJS',
        'Développeur Python', 'Développeur Java', 'Développeur C#', 'Développeur C++', 'Développeur C',
        'Développeur Ruby', 'Développeur PHP', 'Développeur Go', 'Développeur Rust', 'Développeur Swift',
        'Développeur Kotlin', 'Développeur Dart', 'Développeur Scala', 'Développeur Groovy', 'Développeur Kotlin',
        'Administrateur système', 'Administrateur réseau', 'Administrateur base de données', 'Administrateur serveur',
        'Administrateur cloud', 'Administrateur sécurité', 'Administrateur système', 'Administrateur réseau',
        'Consultant SEO', 'Consultant en développement', 'Consultant en sécurité', 'Consultant en cloud', 'Consultant en réseau',
        'Community manager', 'Chef de projet', 'Chef de projet web', 'Chef de projet mobile', 'Chef de projet digital', 'Chef de projet marketing',
        'Graphiste', 'Designer', 'Designer web', 'Designer mobile', 'Designer UX', 'Designer UI', 'Designer graphique', 'Designer produit',
        'Rédacteur web', 'Correcteur'];

        foreach ($keywords as $keyword) {
            $key = new Keyword();
            $key->setName($keyword);
            $manager->persist($key);
            $manager->flush();
        }

        // LES CATEGORIES
        $categories = ['Développeur', 'Administrateur', 'Consultant', 'Chef de projet', 'Graphiste', 'Designer', 'Rédacteur', 'Correcteur'];

        foreach ($categories as $category) {
            $cat = new Category();
            $cat->setName($category);
            $manager->persist($cat);
            $manager->flush();
        }

        // get both categories and keywords from database
        $categories_list = $manager->getRepository(Category::class)->findAll();
        $keywords_list = $manager->getRepository(Keyword::class)->findAll();

        //Fake Freelancers and Companies

        $categoryR = new Category();
        $categoryR->setName('Développeur full stack');
        $manager->persist($categoryR);
        $manager->flush();
        
        $genres = ['male', 'female'];
        $roles = ['ROLE_FREELANCER', 'ROLE_COMPANY'];

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();

            $genre = $this->faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $this->faker->numberBetween(1, 99) . '.jpg';

            if ($genre == "male") {
                $picture .= "men/".$pictureId;
            } else {
                $picture .=  "women/".$pictureId;
            }

            $role = $this->faker->randomElement($roles);

            if($role == "ROLE_FREELANCER"){
                $freelance = new Freelance();


                $profile = new MediaObject();
                $profile->setFilePath($picture); //default image url from faker

                $cv = new MediaObject();
                $cv->setFilePath($picture); //default image url from faker

                $freelance->setName($this->faker->firstName($genre))
                ->setSurname($this->faker->lastName($genre))
                ->setBirthday($this->faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'))
                ->setSiretnumber($this->faker->numberBetween(10000000, 999999999))
                ->setProfile($profile)
                ->setCv($cv)
                ->setUserId($user);

                $rand_keywords = $this->faker->randomElements($keywords_list, 3);
                foreach ($rand_keywords as $keyword) {
                    $keyword->addFreelance($freelance);
                }

                $user->setRoles(['ROLE_USER', $role])
                ->setEmail($this->faker->email())
                ->setPassword($this->userPasswordHasher->hashPassword($user, 'pass_12345'))
                ->setFreelance($freelance);

                $manager->persist($user);
                array_push($freelancers, $freelance);

            }else{

                $company = new Company();

                $logo = new MediaObject();
                $logo->setFilePath($picture); //default image url from faker this would be the default if file absent

                $company->setName($this->faker->company())
                ->setSiretnumber($this->faker->numberBetween(10000000, 999999999))
                ->setLogo($logo)
                ->setUser($user)
                ->setAddress($this->faker->address());

                $user->setRoles(['ROLE_USER', $role])
                ->setEmail($this->faker->email())
                ->setPassword($this->userPasswordHasher->hashPassword($user, 'pass_12345'))
                ->setCompany($company);
                $manager->persist($user);
                array_push($companies, $company);
            }

            $manager->flush();
        }

        //Fake Companies Offers

        foreach ($companies as $company) {
                for ($i = 1; $i <= 2; $i++) {
                    $offer = new Offer();
                    $new_category = $categories_list[mt_rand(0, count($categories_list) - 1)];
                    $offer->setTitle($this->faker->sentence(1))
                    ->setDescription($this->faker->paragraph(1))
                    ->setCompany($company)
                    ->setSalary($this->faker->numberBetween(2000, 100000))
                    ->setCategory($new_category);

                    $rand_keywords = $this->faker->randomElements($keywords_list, 3);
                    foreach ($rand_keywords as $keyword) {
                        $keyword->addOffer($offer);
                    }

                    //add freelancers
                    $rand_freelancers = $this->faker->randomElements($freelancers, 3);
                    foreach ($rand_freelancers as $freelancer) {
                        $offer->addCandidate($freelancer);
                    }

                    // add selected freelancer
                    $offer->setSelectedCandidate($rand_freelancers[0]);

                    // fake company and selected candidate comments
                    for ($i=0; $i < 2; $i++) {
                        $companyComment = new Comment();
                        $companyComment->setAuthor($company->getUser())
                        ->setOffer($offer)
                        ->setComment($this->faker->paragraph(1));
                        $manager->persist($companyComment);
                        $manager->flush();

                        // add candidate comment
                        $candidateComment = new Comment();
                        $candidateComment->setAuthor($offer->getSelectedCandidate()->getUserId())
                        ->setOffer($offer)
                        ->setComment($this->faker->paragraph(1));
                        $manager->persist($companyComment);
                        $manager->flush();
                    }

                    $manager->persist($offer);
                    $manager->flush();
            }
        }

    }
}
