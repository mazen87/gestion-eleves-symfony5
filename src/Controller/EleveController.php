<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveType;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EleveController extends AbstractController
{
   /**
    *@Route("/eleve/add", name="eleve_add") 
    */ 
   public function add (Request $request, EntityManagerInterface $em){

      $eleve  = new Eleve();
      $addEleveForm = $this->createForm(EleveType::class, $eleve);
      $addEleveForm->handleRequest($request);
      if($addEleveForm->isSubmitted() && $addEleveForm->isValid()){
         $em->persist($eleve);
         $em->flush();

         $this->addFlash('succes','votre Elève a été ajouté avec succes');
         return $this->redirectToRoute('accueil');

      }
      //$em = $this->getDoctrine()->getManager();
      //$em->persist($eleve);
      //$em->flush();

    return $this->render('eleve/add.html.twig', [
       'addEleveForm' => $addEleveForm->createView()
    ]);
   }

   /**
    * @Route("/accueil", name="accueil")
    */
    public function accueil (){
       $eleveRepo = $this->getDoctrine()->getRepository(Eleve::class);
       $eleves = $eleveRepo->findAll();

      return $this->render('accueil/accueil.html.twig',
       ['eleves'=>$eleves]);
    }
}
