<?php

namespace App\Controller;

use App\Entity\Domaine;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomController extends AbstractController
{
    private $em;
    private $domaineRepository;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
        $this->domaineRepository=$this->em->getRepository(Domaine::class);
    }

    /**
     * @Route("/", name="welcom")
     */
    public function index(): Response
    {
        $array=
        [
            'niveau_etudes'=> array("Aucun","BFEM","BAC","Licence","Master","Ingénieur","Doctorat"),
            'annee_experiences'=> array("Aucun","1 ans","2 ans","3 ans","4 ans","5 ans et plus"),
            'domaines'=> $this->domaineRepository->findAll(),
        ];
        if($this->getUser()!=null)
            if($this->getUser()->getEntreprise()!=null)
                $array['offres']=$this->getUser()->getEntreprise()->getOffres();
            else
                $array['offres']=array();
        return $this->render('welcom/index.html.twig', $array);
    }
}
