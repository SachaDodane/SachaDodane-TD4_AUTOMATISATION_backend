<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/person')]
class PersonController extends AbstractController
{
    #[Route('/', name: 'app_person_index', methods: ['GET'])]
    public function index(PersonRepository $personRepository): Response
    {
        return $this->render('person/index.html.twig', [
            'people' => $personRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_person_show', methods: ['GET'])]
    public function show(Person $person): Response
    {
        return $this->render('person/show.html.twig', [
            'person' => $person,
        ]);
    }
}
