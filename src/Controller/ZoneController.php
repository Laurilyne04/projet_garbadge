<?php

namespace App\Controller;

use App\Entity\Zone;
use App\Form\ZoneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ZoneController extends AbstractController
{
    #[Route('/zone', name: 'app_zone')]
    public function index(): Response
    {
        return $this->render('zone/index.html.twig', [
            'controller_name' => 'ZoneController',
        ]);
    }

    #[Route('/zone/add', name: 'app_zone_add')]
    public function add(ManagerRegistry $doctrine,Request $request): Response
    {
        $repository = $doctrine -> getRepository(Zone::class);
        $zones = $repository->findAll();

        $entityManager = $doctrine->getManager();
        $zone=new Zone();
        $dateActuelle = new \DateTime('now');
        $zone->setdateInscription($dateActuelle);

        $form = $this->createForm(Zonetype::class,$zone);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $entityManager->persist($zone);
            $entityManager->flush();
            $reponse = $this->redirectToRoute("app__add");
        }
        else
        {
            $reponse = $this->render('zone/add.html.twig', [
                'formulaire' => $form->createView(),
            ]);
        }

        return $reponse;
    }
}
