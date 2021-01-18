<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\EleveParClasseType;
use App\Form\EleveType;
use App\Repository\ClasseRepository;
use App\Repository\EleveRepository;
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
    *@Route("/eleve/Modifier/{id}", name="eleve_modifier",requirements={"id"="\d+"}) 
    */ 
    public function modifier (Request $request, EntityManagerInterface $em,$id,EleveRepository $eleveRepo){

      //$eleve  = new Eleve();
      //$eleve= $eleveRepo->find($idEleve);
      $eleve = $eleveRepo->selectEleveEtClasse($id);
      if(empty($eleve)){
         throw $this->createNotFoundException("Elève n'éxiste pas !");
      }
      $modifierEleveForm = $this->createForm(EleveType::class,  $eleve);
      $modifierEleveForm->handleRequest($request);
      if($modifierEleveForm->isSubmitted() && $modifierEleveForm->isValid()){
         $em->persist($eleve);
         $em->flush();
         $this->addFlash('succes','votre Elève a été modifié avec succes');
         return $this->redirectToRoute('accueil');

      }
    return $this->render('eleve/modifier.html.twig', [
       'modifierEleveForm' => $modifierEleveForm->createView()
    ]);
   }

   /**
    * @Route("/accueil", name="accueil")
    */
    public function accueil (EleveRepository $eleveRepo,Request $request,ClasseRepository $classeRepo){
       //$eleveRepo = $this->getDoctrine()->getRepository(Eleve::class);
       //$eleves = $eleveRepo->findAll();
       //$eleve = new Eleve();
       //$elevesParClasseForm = $this->createForm(EleveParClasseType::class);
       //$elevesParClasseForm->handleRequest($request);
       //$eleve = $elevesParClasseForm->getData();  
       //if($elevesParClasseForm->isSubmitted()){

         //$eleves =  $eleveRepo->selectElevesParClasse($eleve->getClasse()->getId());
         $id = intval($request->request->get('filtrer'));
         if($id===0){
            $eleves = $eleveRepo->selectElevesEtClasses();
         }else{
            $eleves = $eleves =  $eleveRepo->selectElevesParClasse($id);
         }
         if(empty($eleves)){
            throw $this->createNotFoundException("Aucun Elève éxiste !");
         }
         $classes = $classeRepo->findAll();
         if(empty($classes)){
            throw $this->createNotFoundException("Aucune classe éxiste !");
         }
      return $this->render('accueil/accueil.html.twig',
       [ 'eleves'=>$eleves,
         //'elevesParClasseForm'=>$elevesParClasseForm->createView() 
         'classes'=>$classes
       ]);
    }

    /**
     * @Route("/accueil/classe", name="accueil_classe")
     */
    public function accueilParClasse (EleveRepository $eleveRepo , Request $request){
      $eleve = new Eleve();
      $elevesParClasseForm = $this->createForm(EleveParClasseType::class,$eleve);
      if($elevesParClasseForm->isSubmitted()){

        $eleves =  $eleveRepo->selectElevesParClasse($eleve->getClasse()->getId());
        dump($request);
       
      }

     return $this->render('accueil/accueil.html.twig',
      ['eleves'=>$eleves,
       'elevesParClasseForm'=>$elevesParClasseForm->createView() 
      ]);
   }
}
