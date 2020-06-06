<?php
namespace App\Controller;

use App\DAO\PlatesDAO;
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
        ProductCategoryRepository $productCategoryRepository,
        PlatesDAO $platesDAO
        )
    {
        $dao = new PlatesDAO();
        $allPlates = $dao->getAllPlatesByCategory($plateRepository);
        dump($allPlates);
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