<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\SecteurActivite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    private $em;
    private $entrepriseRepository;
    private $secteurRepository;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
        $this->entrepriseRepository=$this->em->getRepository(Entreprise::class);
        $this->secteurRepository=$this->em->getRepository(SecteurActivite::class);
    }

    /**
     * @Route("/entreprise", name="app_entreprise")
     */
    public function index(): Response
    {

        return $this->render('entreprise/index.html.twig', [
            'secteurs' => $this->secteurRepository->findAll(),
        ]);
    }


    /**
     * @Route("/entreprise/edit", name="app_entreprise_edit")
     */
    public function profil(): Response
    {
        return $this->render('entreprise/index.html.twig', [
            'controller_name' => 'EntrepriseController',
        ]);
    }
}
