<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Attribute\Route;

 #[Route('/api/brands/')]
final class BrandApiController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em,
                                private BrandRepository $repository,
                                private ValidatorInterface $validator)
    {
        
    }
     
    // List of brands by country code and  type bestRated
    #[Route('bestRated', name: 'api_brand_list_bestRated', methods:['GET'])]
    public function index(Request $request, SerializerInterface $serializer ): JsonResponse
    {
        $countryCode = $request->headers->get('CF-IPCountry') ?? 'FR';

        $brands = $this->repository->findByCountryAndBestRated($countryCode);
    
        $data = $serializer->normalize($brands, null, ['groups' => 'brand:read']);
        return $this->json($data, 200);
        
    }
    
    // List of brands by country code and  type new
    #[Route('new', name: 'api_brand_list_new', methods:['GET'])]
    public function brandsByNew(Request $request, SerializerInterface $serializer ): JsonResponse
    {
        $countryCode = $request->headers->get('CF-IPCountry') ?? 'FR';

        $brands = $this->repository->findByCountryAndNew($countryCode);
    
        $data = $serializer->normalize($brands, null, ['groups' => 'brand:read']);
        return $this->json($data, 200);
        
    }

    // List of brands by country code and  type featured
    #[Route('featured', name: 'api_brand_list_featured', methods:['GET'])]
    public function brandsByFeatured(Request $request, SerializerInterface $serializer ): JsonResponse
    {
        $countryCode = $request->headers->get('CF-IPCountry') ?? 'FR';

        $brands = $this->repository->findByCountryAndFeatured($countryCode);
    
        $data = $serializer->normalize($brands, null, ['groups' => 'brand:read']);
        return $this->json($data, 200);
        
    }

    // List of brands by country code
    #[Route('', name: 'api_brand_list', methods:['GET'])]
    public function brandByCountryCode(Request $request, SerializerInterface $serializer ): JsonResponse
    {
        $countryCode = $request->headers->get('CF-IPCountry') ?? 'FR';

        $brands = $this->repository->findByCountryCode($countryCode);
    
        $data = $serializer->normalize($brands, null, ['groups' => 'brand:read']);
        return $this->json($data, 200);
        
    }
    
    // Create brand
    #[Route('create', name: 'api_brand_create', methods:['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $brand =new Brand();
        $brand->setBrandName($data['brandName']);
        $brand->setBrandImage($data['brandImage']);
        $brand->setRating($data['rating']);
        $brand->setTargetCountries($data['targetCountries']);

        $errors = $this->validator->validate($brand);

        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->em->persist($brand);
        $this->em->flush();
        return $this->json(['message' => 'Brand successfully created'], 201);
    }

    // Delete brand
    #[Route('{id}/delete', name: 'api_brand_delete', methods:['DELETE'])]
    public function delete(Brand $brand): JsonResponse
    {
        $this->em->remove($brand);
        $this->em->flush();

        return $this->json(['message' => 'Brand successfully deleted']);
          
    }

    #[Route('{id}/show', name: 'api_brand_show', methods: ['GET'])]
    public function show(Brand $brand): JsonResponse
    {
        return $this->json($brand, 200, [], ['groups' => 'brand:read']);
    }

    // Update brand
    #[Route('{id}/update', name: 'api_brand_update', methods: ['PUT'])]
    public function update(Request $request, Brand $brand): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        var_dump($data['brandName']);

        if (isset($data['brandName'])){
            $brand->setBrandName($data['brandName']);
        }
        if (isset($data['rating'])){
            $brand->setRating($data['rating']);
        }
        if (isset($data['brandImage'])){
            $brand->setBrandImage($data['brandImage']);
        }
        if (isset($data['targetCountries'])){
            $brand->setTargetCountries($data['targetCountries']);
        }

        $errors = $this->validator->validate($brand);

        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->em->persist($brand);
        $this->em->flush();

        return $this->json(['message' => 'Brand successfully updated'], 200);
    }


}
