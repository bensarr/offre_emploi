<?php

namespace App\Controller;

use App\Entity\Domaine;
use App\Entity\Offre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    private $em;
    private $offreRepository;
    private $domaineRepository;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
        $this->domaineRepository=$this->em->getRepository(Domaine::class);
        $this->offreRepository=$this->em->getRepository(Offre::class);
    }
    /**
     * @Route("/offre", name="app_offre")
     */
    public function index(): Response
    {
        return $this->render('offre/index.html.twig');
    }

    /**
     * @Route("/offre/new", name="app_offre_new")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request): Response
    {
        if($request->isMethod("POST")) {

            $offre = new Offre();
            $id=$request->request->get('id');
            if ( $id!= 0)
            {
                $offre = $this->offreRepository->find($id);
            }
            $offre->setTitre($request->request->get('titre'));
            $offre->setDescription($request->request->get('description'));
            $offre->setNiveauEtude($request->request->get('niveau_etude'));
            $offre->setNbrAnneeExperience($request->request->get('annee_experience'));
            $domainesId=$request->request->get('domaines');
            $domaines=$this->domaineRepository->find($domainesId);
            $offre->setDomaines($domaines);

            if ( $id==0) {
                $this->em->persist($offre);
                $offre->setEntreprise($this->getUser()->getEntreprise());
            }
            $this->em->flush();

        }
        return $this->redirectToRoute('welcom');

    }
}
