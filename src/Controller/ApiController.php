<?php
namespace App\Controller;

use App\Repository\PlateRepository;
use App\Repository\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{
    /**
     * @Route(path="/api/plates", name="api_plates")
     *
     * @param PlateRepository $plateRepository
     * @param Serializer $serializer
     * @return JsonResponse
     */
    public function getAllPlates(PlateRepository $plateRepository, 
    SerializerInterface $serializer)
    {
        $plates = $plateRepository->findAll();
        $data = $serializer->serialize($plates, 'json', ['groups' => 'public']);
        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Route(path="/api/categories", name="api_categories")
     *
     * @param ProductCategoryRepository $categoryRepository
     * @param Serializer $serializer
     * @return JsonResponse
     */
    public function getAllCategories(ProductCategoryRepository $categoryRepository, 
    SerializerInterface $serializer)
    {
        $plates = $categoryRepository->findAll();
        $data = $serializer->serialize($plates, 'json', ['groups' => 'public']);
        return new JsonResponse($data, 200, [], true);
    }
}
