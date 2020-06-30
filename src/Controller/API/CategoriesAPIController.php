<?php


namespace App\Controller\API;


use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use App\Uploader\ImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CategoriesAPIController
 * @package App\Controller\API
 * @Route(path="/api/v2/categories")
 */
class CategoriesAPIController extends AbstractController
{
    private $serializer;
    private $entityManager;
    private $imageUploader;
    private $context = [];

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager, ImageUploader $imageUploader)
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->imageUploader = $imageUploader;
        $this->context = ['groups' => ['public']];
    }

    /**
     * @Route(path="/", name="api_categories", methods={"GET"})
     * @param ProductCategoryRepository $productCategoryRepository
     * @return JsonResponse
     */
    public function categories(ProductCategoryRepository $productCategoryRepository)
    {
        $categories = $productCategoryRepository->findAll();
        $data = $this->serializer->serialize($categories, 'json', $this->context);
        return new JsonResponse($data, Response::HTTP_OK);
    }
}
