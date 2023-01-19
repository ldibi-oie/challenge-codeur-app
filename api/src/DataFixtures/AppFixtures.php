<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Company;
use App\Entity\Offer;
use App\Entity\Subcription;
use App\Entity\Freelance;
use App\Entity\Keyword;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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

            $subcription = new Subcription();
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
