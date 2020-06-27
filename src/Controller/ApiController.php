<?php
namespace App\Controller;

use App\Repository\PlateRepository;
use App\Repository\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    protected $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route(path="/plates", name="api_plates")
     *
     * @param PlateRepository $plateRepository
     * @return JsonResponse
     */
    public function getAllPlates(PlateRepository $plateRepository)
    {
        $plates = $plateRepository->findAll();
        $data = $this->serializer->serialize($plates, 'json', ['groups' => 'public']);
        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Route(path="/categories", name="api_categories")
     *
     * @param ProductCategoryRepository $categoryRepository
     * @return JsonResponse
     */
    public function getAllCategories(ProductCategoryRepository $categoryRepository)
    {
        $plates = $categoryRepository->findAll();
        $data = $this->serializer->serialize($plates, 'json', ['groups' => 'public']);
        return new JsonResponse($data, 200, [], true);
    }
}
