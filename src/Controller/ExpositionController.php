<?php

namespace App\Controller;

use App\Entity\Exposition;
use App\Entity\OeuvreExposee;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExpositionController extends AbstractController
{
    /**
     * @Route("/expositions", name="expositions")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Exposition::class);
        $expositions = $repo->findAll();
        
        return $this->render('exposition/index.html.twig', ['expositions' => $expositions]);
    }
    /**
     * @Route("/exposition", name="exposition")
     */
    public function expositionUn(EntityManagerInterface $em): Response
    {
        // $repo = $em->getRepository(Exposition::class);
        // $exposition = $repo->find($_GET['id']);
        
        // return $this->render('exposition/exposition.html.twig', ['exposition' => $exposition]);

        // $repo = $em->getRepository(OeuvreExposee::class);
        // $exposition = $repo->jointure($_GET['id']);
        // return $this->render('exposition/exposition.html.twig', ['exposition' => $exposition]);

        $repo = $em->getRepository(Exposition::class);
        $exposition = $repo->find($_GET['id']);

        $repo2 = $em->getRepository(OeuvreExposee::class);
        $expositions = $repo2->jointure($_GET['id']);

        return $this->render('exposition/exposition.html.twig', ['exposition' => $exposition,'expositions' => $expositions]);

    }

    /**
     * @Route("/exposition/create",name="exposition_create", methods={"GET", "POST"})
    */
    public function createExposition(Request $request, EntityManagerInterface $em): Response
    {
       $form = $this->createFormBuilder()
            ->add('nom', TextType::class)
            ->add('lieu', TextType::class)
            ->add('adresse', TextType::class)
            ->add('date_debut', DateType::class)
            ->add('date_fin', DateType::class)
            ->add('date_vernissage', DateTimeType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $exposition = new Exposition;
            $exposition->setNom($data['nom']);
            $exposition->setLieu($data['lieu']);
            $exposition->setAdresse($data['adresse']);
            $exposition->setDateDebut($data['date_debut']);
            $exposition->setDateFin($data['date_fin']);
            $exposition->setDateVernissage($data['date_vernissage']);

            $em->persist($exposition);
            $em->flush();

            return $this->redirectToRoute('exposition');
        }
        
        return $this->render('oeuvre/create.html.twig', ['formOeuvre'=> $form->createView()]);
    }

}
