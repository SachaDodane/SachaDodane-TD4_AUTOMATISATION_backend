<?php

namespace App\Controller;

use App\Entity\Building;
use App\Repository\BuildingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/building')]
class BuildingController extends AbstractController
{
    #[Route('/', name: 'app_building_index', methods: ['GET'])]
    public function index(BuildingRepository $buildingRepository): Response
    {
        return $this->render('building/index.html.twig', [
            'buildings' => $buildingRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_building_show', methods: ['GET'])]
    public function show(Building $building): Response
    {
        return $this->render('building/show.html.twig', [
            'building' => $building,
        ]);
    }
}
