<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @Assert\NotBlank(message="ce champ est obligatoire ! ")
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     * @ORM\column(type="string", length=255)
     */
    private $nom;
    /**
     * @Assert\Length(max=255, maxMessage="maximum 255 caractères !")
     * @Assert\NotBlank(message="ce champ est obligatoire ! ")
     * @ORM\column(type="string", length=255)
     */
    private $prenom;
    /**
     * @ORM\column(type="datetime")
     */
    private $dateNaissance;
    /**
     * @Assert\Type(type="number" ,message="saisissez des valeurs valides SVP ! ")
     * @ORM\column(type="float",nullable=true)
     */
    private $moyen;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe" , inversedBy="eleves")
     */
    private $classe;

    


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
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of dateNaissance
     */ 
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set the value of dateNaissance
     *
     * @return  self
     */ 
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get the value of moyen
     */ 
    public function getMoyen()
    {
        return $this->moyen;
    }

    /**
     * Set the value of moyen
     *
     * @return  self
     */ 
    public function setMoyen($moyen)
    {
        $this->moyen = $moyen;

        return $this;
    }

    /**
     * Get the value of classe
     */ 
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set the value of classe
     *
     * @return  self
     */ 
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }
}
