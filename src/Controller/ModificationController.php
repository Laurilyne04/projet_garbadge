<?php

namespace App\Controller;

use App\Entity\Modification;
use App\Form\ModificationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModificationController extends AbstractController
{
    #[Route('/modification', name: 'app_modification')]
    public function index(): Response
    {
        return $this->render('modification/index.html.twig', [
            'controller_name' => 'ModificationController',
        ]);
    }

    #[Route('/Modification/list', name: 'app_Modification_list')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine -> getRepository(Modification::class);
        $modification = $repository->findAll();
        return $this->render('modification/list.html.twig', [
            'modification' => $modification,
        ]);
    }

    #[Route('/modification/add/{id}', name: 'app_modification_add')]
    public function add(ManagerRegistry $doctrine,Request $request): Response
    {
        $repository = $doctrine -> getRepository(Modification::class);
        $utilisateur = $repository->findAll();

        $entityManager = $doctrine->getManager();
        $user=new Modification();
        $dateActuelle = new \DateTime('now');
        $user->setdate($dateActuelle);

        $form = $this->createForm(ModificationType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $reponse = $this->redirectToRoute("app_modification_add");
        }
        else
        {
            $reponse = $this->render('modification/add.html.twig', [
                'formulaire' => $form->createView(),
            ]);
        }

        return $reponse;
    }
}
