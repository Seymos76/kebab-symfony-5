<?php
namespace App\DAO;

use App\Repository\PlateRepository;

class PlatesDAO 
{
    public function getAllPlatesByCategory(PlateRepository $plateRepository)
    {
        $sandwiches = $plateRepository->findSandwiches();
        $hm = $plateRepository->findHomeMades();
        $fries = $plateRepository->findFries();
        $entries = $plateRepository->findEntries();
        $salads = $plateRepository->findSalads();
        $plates = $plateRepository->findPlates();
        $desserts = $plateRepository->findDesserts();
        return [
            'sandwiches' => $sandwiches,
            'home_made' => $hm,
            'fries' => $fries,
            'entries' => $entries,
            'salads' => $salads,
            'plates' => $plates,
            'desserts' => $desserts
        ];
    }
}