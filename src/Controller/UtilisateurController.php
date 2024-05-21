<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    #[Route('/utilisateur/list', name: 'app_utilisateur_list')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine -> getRepository(Utilisateur::class);
        $utilisateurs = $repository->findAll();
        return $this->render('utilisateur/list.html.twig', [
            'utilisateurs' => $utilisateurs,
        ]);
    }


    #[Route('/utilisateur/add', name: 'app_utilisateur_add')]
    public function add(ManagerRegistry $doctrine,Request $request): Response
    {
        $repository = $doctrine -> getRepository(Utilisateur::class);
        $utilisateur = $repository->findAll();

        $entityManager = $doctrine->getManager();
        $user=new Utilisateur();
        $dateActuelle = new \DateTime('now');
        $user->setdateInscription($dateActuelle);

        $form = $this->createForm(UtilisateurType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $reponse = $this->redirectToRoute("app_utilisateur_add");
        }
        else
        {
            $reponse = $this->render('utilisateur/add.html.twig', [
                'formulaire' => $form->createView(),
            ]);
        }

        return $reponse;
    }

    #[Route('/utilisateur/delete/{id}', name: 'app_utilisateur_delete')]
    public function delete(Utilisateur $utilisateur, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($utilisateur);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_utilisateur_list');
    }  


#[Route('/utilisateur/update/{id}', name: 'app_utilisateur_update')]
    public function update(Utilisateur $utilisateur, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateur_list');
        }

        return $this->render('utilisateur/update.html.twig', [
            'controller_name' => 'UtilisateurController',
            'utilisateur' => $utilisateur,
            'formulaire' => $form->createView(),
        ]);
    }

}
