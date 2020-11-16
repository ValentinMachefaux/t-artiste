<?php

namespace App\Controller;

use App\Entity\Oeuvre;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class OeuvreController extends AbstractController
{
    /**
     * @Route("/oeuvres", name="oeuvres")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Oeuvre::class);
        $oeuvres = $repo->findAll();
        
        return $this->render('oeuvre/index.html.twig', ['oeuvres' => $oeuvres]);
    }

    /**
     * @Route("/oeuvre", name="oeuvre")
     */
    public function oeuvreUn(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Oeuvre::class);
        $oeuvre = $repo->find($_GET['id']);
        
        return $this->render('oeuvre/oeuvre.html.twig', ['oeuvre' => $oeuvre]);
    }

    /**
     * @Route("/oeuvre/create",name="oeuvre_create", methods={"GET", "POST"})
     */
    public function createOeuvre(Request $request, EntityManagerInterface $em): Response
    {
       $form = $this->createFormBuilder()
            ->add('titre', TextType::class)
            ->add('annee', IntegerType::class)
            ->add('technique', TextType::class)
            ->add('support', TextType::class)
            ->add('largeur', IntegerType::class)
            ->add('hauteur', IntegerType::class)
            ->add('prix', IntegerType::class)
            ->add('petiteimage', TextType::class)
            ->add('grandeimage', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $oeuvre = new Oeuvre;
            $oeuvre->setTitre($data['titre']);
            $oeuvre->setAnnee($data['annee']);
            $oeuvre->setTechnique($data['technique']);
            $oeuvre->setSupport($data['support']);
            $oeuvre->setLargeur($data['largeur']);
            $oeuvre->setHauteur($data['hauteur']);
            $oeuvre->setPrix($data['prix']);
            $oeuvre->setPetite_image($data['petiteimage']);
            $oeuvre->setGrande_image($data['grandeimage']);

            $em->persist($oeuvre);
            $em->flush();

            return $this->redirectToRoute('oeuvres');
        }
        
        return $this->render('oeuvre/create.html.twig', ['formOeuvre'=> $form->createView()]);
    }

}
