<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    //get all companies
    #[Route('/api/companies', name: 'app_company', methods: ["GET"])]
    public function getCompanies(CompanyRepository $companyRepository, SerializerInterface $serializer): JsonResponse
    {
        $companies = $companyRepository->findAll();
        $jsonCompaniesList = $serializer->serialize($companies,'json');
        return new JsonResponse($jsonCompaniesList, Response::HTTP_OK, [], true);
    }

    //get one company
    #[Route('/api/companies/{id}', name: 'app_company', methods: ["GET"])]
    public function getCompany(CompanyRepository $companyRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $company = $companyRepository->find($id);
        $jsonCompany = $serializer->serialize($company,'json');
        return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
    }

    //get all companies with pagination
    #[Route('/api/companies/{page}', name: 'app_company', methods: ["GET"])]
    public function getCompaniesWithPagination(CompanyRepository $companyRepository, SerializerInterface $serializer, int $page): JsonResponse
    {
        $companies = $companyRepository->findAll();
        $jsonCompaniesList = $serializer->serialize($companies,'json');
        return new JsonResponse($jsonCompaniesList, Response::HTTP_OK, [], true);
    }

    //get company by name
    #[Route('/api/companies/{name}', name: 'app_company', methods: ["GET"])]
    public function getCompanyByName(CompanyRepository $companyRepository, SerializerInterface $serializer, string $name): JsonResponse
    {
        $company = $companyRepository->findOneBy(['name' => $name]);
        $jsonCompany = $serializer->serialize($company,'json');
        return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
    }

    //get company by siret
    #[Route('/api/companies/{siret}', name: 'app_company', methods: ["GET"])]
    public function getCompanyBySiret(CompanyRepository $companyRepository, SerializerInterface $serializer, string $siret): JsonResponse
    {
        $company = $companyRepository->findOneBy(['siret' => $siret]);
        $jsonCompany = $serializer->serialize($company,'json');
        return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
    }

    //get company by address
    #[Route('/api/companies/{address}', name: 'app_company', methods: ["GET"])]
    public function getCompanyByAddress(CompanyRepository $companyRepository, SerializerInterface $serializer, string $address): JsonResponse
    {
        $company = $companyRepository->findOneBy(['address' => $address]);
        $jsonCompany = $serializer->serialize($company,'json');
        return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
    }

    //create company 
    #[Route('/api/companies', name: 'app_company', methods: ["POST"])]
    public function createCompany(CompanyRepository $companyRepository, SerializerInterface $serializer): JsonResponse
    {
        $company = $companyRepository->findAll();
        $jsonCompany = $serializer->serialize($company,'json');
        return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
    }

    //update company
    #[Route('/api/companies/{id}', name: 'app_company', methods: ["PUT"])]
    public function updateCompany(CompanyRepository $companyRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $company = $companyRepository->find($id);
        $jsonCompany = $serializer->serialize($company,'json');
        return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
    }

    //delete company
    #[Route('/api/companies/{id}', name: 'app_company', methods: ["DELETE"])]
    public function deleteCompany(CompanyRepository $companyRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $company = $companyRepository->find($id);
        $jsonCompany = $serializer->serialize($company,'json');
        return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
    }

    //add offre with company
    #[Route('/api/companies/{id}/offres', name: 'app_company', methods: ["POST"])]
    public function addOffreWithCompany(CompanyRepository $companyRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $company = $companyRepository->find($id);
        $jsonCompany = $serializer->serialize($company,'json');
        return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
    }
}
