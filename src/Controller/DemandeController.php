<?php

namespace App\Controller;

use App\Entity\Demande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeController extends AbstractController
{
    private $em;
    private $demandeRepository;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
        $this->demandeRepository=$this->em->getRepository(Demande::class);
    }

    /**
     * @Route("/demande/accept/{id}", name="app_demande_accept")
     */
    public function accept($id): Response
    {
        $d=$this->demandeRepository->find($id);
        if($d!=null)
        {
            $d->setReponse(true);
            $this->em->flush();
        }
        return $this->redirectToRoute('app_entreprise');
    }
}
