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
    #[Route('/api/companies/{id}', name: 'app_company_detail', methods: ["GET"])]
    public function getOneCompany(CompanyRepository $companyRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $company = $companyRepository->find($id);
        if($company){
            $jsonCompany = $serializer->serialize($company,'json');
            return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
        }

        return new JsonResponse("Company not found", Response::HTTP_NOT_FOUND, [], true);

    }

    //get one company by name
    #[Route('/api/companies/name/{name}', name: 'app_company_detail_name', methods: ["GET"])]
    public function getOneCompanyByName(CompanyRepository $companyRepository, SerializerInterface $serializer, string $name): JsonResponse
    {
        $company = $companyRepository->findOneBy(['name' => $name]);
        if($company){
            $jsonCompany = $serializer->serialize($company,'json');
            return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
        }

        return new JsonResponse("Company name not found", Response::HTTP_NOT_FOUND, [], true);

    }

    //get one company by siret number
    #[Route('/api/companies/siret/{siretnumber}', name: 'app_company_detail_siret', methods: ["GET"])]
    public function getOneCompanyBySiret(CompanyRepository $companyRepository, SerializerInterface $serializer, int $siretnumber): JsonResponse
    {
        $company = $companyRepository->findOneBy(['siretnumber' => $siretnumber]);
        if($company){
            $jsonCompany = $serializer->serialize($company,'json');
            return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
        }

        return new JsonResponse("Company siret number not found", Response::HTTP_NOT_FOUND, [], true);

    }

    //get one company by email
    #[Route('/api/companies/email/{email}', name: 'app_company_detail_email', methods: ["GET"])]
    public function getOneCompanyByEmail(CompanyRepository $companyRepository, SerializerInterface $serializer, string $email): JsonResponse
    {
        $company = $companyRepository->findOneBy(['email' => $email]);
        if($company){
            $jsonCompany = $serializer->serialize($company,'json');
            return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
        }

        return new JsonResponse("Company email not found", Response::HTTP_NOT_FOUND, [], true);

    }


    //get one company by address
    #[Route('/api/companies/address/{address}', name: 'app_company_detail_address', methods: ["GET"])]
    public function getOneCompanyByAddress(CompanyRepository $companyRepository, SerializerInterface $serializer, string $address): JsonResponse
    {
        $company = $companyRepository->findOneBy(['address' => $address]);
        if($company){
            $jsonCompany = $serializer->serialize($company,'json');
            return new JsonResponse($jsonCompany, Response::HTTP_OK, [], true);
        }

        return new JsonResponse("Company address not found", Response::HTTP_NOT_FOUND, [], true);

    }

    //create company
    #[Route('/api/companies', name: 'app_company_create', methods: ["POST"])]
    public function createCompany(CompanyRepository $companyRepository, SerializerInterface $serializer): JsonResponse
    {
        $company = $serializer->deserialize($this->request->getContent(), Company::class, 'json');
        $companyRepository->save($company);
        return new JsonResponse("Company created", Response::HTTP_CREATED, [], true);
    }

    //update company
    #[Route('/api/companies/{id}', name: 'app_company_update', methods: ["PUT"])]
    public function updateCompany(CompanyRepository $companyRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $company = $companyRepository->find($id);
        if($company){
            $company = $serializer->deserialize($this->request->getContent(), Company::class, 'json');
            $companyRepository->save($company);
            return new JsonResponse("Company updated", Response::HTTP_OK, [], true);
        }

        return new JsonResponse("Company not found", Response::HTTP_NOT_FOUND, [], true);
    }

    //delete company
    #[Route('/api/companies/{id}', name: 'app_company_delete', methods: ["DELETE"])]
    public function deleteCompany(CompanyRepository $companyRepository, SerializerInterface $serializer, int $id): JsonResponse
    {
        $company = $companyRepository->find($id);
        if($company){
            $companyRepository->delete($company);
            return new JsonResponse("Company deleted", Response::HTTP_OK, [], true);
        }

        return new JsonResponse("Company not found", Response::HTTP_NOT_FOUND, [], true);
    }
}
