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
        $sandwiches = $plateRepository->findSandwiches();
        $hm = $plateRepository->findHomeMades();
        $fries = $plateRepository->findFries();
        $entries = $plateRepository->findEntries();
        $salads = $plateRepository->findSalads();
        $plates = $plateRepository->findPlates();
        $desserts = $plateRepository->findDesserts();
        $categories = $productCategoryRepository->findAll();
        return $this->render(
            'public/index.html.twig',
            [
                'categories' => $categories
            ]
        );
    }
}