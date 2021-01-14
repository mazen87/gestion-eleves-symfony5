<?php

namespace App\Controller;

use App\Entity\Classe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClasseController extends AbstractController
{
    /**
     * @Route("/classe/add", name="classe_add")
     */
   public function add( EntityManagerInterface $em){
            $classe = new Classe();
            $classe->setClasseName("classe-3");
          $em->persist($classe);
           $em->flush();

           return $this->redirectToRoute('accueil');
   }
}
