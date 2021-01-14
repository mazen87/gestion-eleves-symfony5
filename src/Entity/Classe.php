<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     * @Assert\NotBlank(message="ce champ est obligatoire ! ")
     * @ORM\Column(type="string", length=255)
     */
    private $ClasseName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eleve", mappedBy="classe")
     */
    private $eleves;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of ClasseName
     */ 
    public function getClasseName()
    {
        return $this->ClasseName;
    }

    /**
     * Set the value of ClasseName
     *
     * @return  self
     */ 
    public function setClasseName($ClasseName)
    {
        $this->ClasseName = $ClasseName;

        return $this;
    }

    /**
     * Get the value of eleves
     */ 
    public function getEleves()
    {
        return $this->eleves;
    }

    /**
     * Set the value of eleves
     *
     * @return  self
     */ 
    public function setEleves($eleves)
    {
        $this->eleves = $eleves;

        return $this;
    }
}
