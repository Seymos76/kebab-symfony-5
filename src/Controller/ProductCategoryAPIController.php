<?php
namespace App\Controller;

use App\Repository\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Annotations\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductCategoryAPIController extends AbstractController
{
    private $productCategoryRepository;
    private $serializer;

    public function __construct(ProductCategoryRepository $productCategoryRepository,
    SerializerInterface $serializer)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->serializer = $serializer;
    }

    public function category(Request $request) 
    {
        $category = $this->productCategoryRepository->find($request->attributes->get('id'));
        $data = $this->serializer->serialize($category, 'json', ['groups' => 'public']);
        return new JsonResponse($data, 200, [], true);
    }

    public function categories() 
    {
        $categories = $this->productCategoryRepository->findAll();
        $data = $this->serializer->serialize($categories, 'json', ['groups' => 'public']);
        return new JsonResponse($data, 200, [], true);
    }
}