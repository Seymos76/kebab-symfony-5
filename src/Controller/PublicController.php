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
        return $this->render(
            'public/index.html.twig',
            [
                'categories' => $productCategoryRepository->findAll(),
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

    /**
     * @Route(path="/pwa", name="public_pwa")
     */
    public function pwa()
    {
        return $this->render(
            'base_pwa.html.twig'
        );
    }
}
