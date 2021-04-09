<?php

namespace App\Controller;

use App\Entity\Entreprise;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    private $em;
    private $entrepriseRepository;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
        $this->entrepriseRepository=$this->em->getRepository(Entreprise::class);
    }

    /**
     * @Route("/entreprise", name="app_entreprise")
     */
    public function index(): Response
    {

        return $this->render('entreprise/index.html.twig', [
            'controller_name' => 'EntrepriseController',
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
