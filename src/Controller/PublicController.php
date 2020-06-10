<?php
namespace App\Controller;

use App\Repository\PlateRepository;
use App\Repository\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController {

    /**
     * Returns Home
     * @Route(path="/", name="public_homepage")
     */
    public function homepage(
        PlateRepository $plateRepository,
        ProductCategoryRepository $productCategoryRepository
        )
    {
        $categories = $productCategoryRepository->findAll();
        dump($plateRepository->findAll());
        return $this->render(
            'public/index.html.twig',
            [
                'categories' => $categories,
                'products' => $plateRepository->findAll()
            ]
        );
    }

    /**
     * @Route(path="/product/", name="public_product")
     */
    public function product()
    {
        return $this->render(
            'public/product.html.twig'
        );
    }
}