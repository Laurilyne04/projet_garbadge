<?php

namespace App\Controller;

use App\Entity\Repas;
use App\Form\RepasType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepasController extends AbstractController
{
    #[Route('/repas', name: 'app_repas')]
    public function index(): Response
    {
        return $this->render('repas/index.html.twig', [
            'controller_name' => 'RepasController',
        ]);
    }

    #[Route('/repas/list', name: 'app_repas_list')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine -> getRepository(Repas::class);
        $repas = $repository->findAll();
        return $this->render('repas/list.html.twig', [
            'repas' => $repas ,
        ]);
    }

    #[Route('/repas/update/{id}', name: 'app_repas_update')]
    public function update(Repas $repas, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RepasType::class, $repas);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_modification_add');
        }

        return $this->render('repas/update.html.twig', [
            'controller_name' => 'RepasController',
            'repas' => $repas,
            'formulaire' => $form->createView(),
        ]);
    }
}
