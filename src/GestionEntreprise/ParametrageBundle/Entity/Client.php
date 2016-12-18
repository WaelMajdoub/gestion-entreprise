<?php

namespace GestionEntreprise\ParametrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestionEntreprise\ParametrageBundle\Entity\Client
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionEntreprise\ParametrageBundle\Entity\ClientRepository")
 */
class Client
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string $prenom
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;
    
    /**
     * @var Civilite $civilite
     *
     * @ORM\ManyToOne(targetEntity="GestionEntreprise\ParametrageBundle\Entity\Civilite")
     */
    private $civilite;

    /**
     * @var string $telephone
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string $telephone2
     *
     * @ORM\Column(name="telephone2", type="string", length=255, nullable=true)
     */
    private $telephone2;
    
    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var Adresse $adresse
     *
     * @ORM\ManyToOne(targetEntity="GestionEntreprise\ParametrageBundle\Entity\Adresse")
     */
    private $adresse;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set civilite
     *
     * @param Civilite $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    /**
     * Get civilite
     *
     * @return civilite 
     */
    public function getCivilite()
    {
        return $this->civilite;
    }
    
    /**
     * Set telephone
     *
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set telephone2
     *
     * @param string $telephone2
     */
    public function setTelephone2($telephone2)
    {
        $this->telephone2 = $telephone2;
    }

    /**
     * Get telephone2
     *
     * @return string 
     */
    public function getTelephone2()
    {
        return $this->telephone2;
    }
    
    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set adresse
     *
     * @param Adresse $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * Get adresse
     *
     * @return Adresse 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
    
    public function __toString() 
    {
        return $this->getNom()." ".$this->getPrenom()." (".$this->getAdresse()->getVille().")";
    }
}
