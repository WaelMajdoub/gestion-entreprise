<?php

namespace GestionEntreprise\ParametrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiementRepository")
 */
class MoyenDePaiement
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
     * @var string $libelle
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var boolean $defaut
     *
     * @ORM\Column(name="defaut", type="boolean")
     */
    private $defaut;


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
     * Set libelle
     *
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set defaut
     *
     * @param boolean $defaut
     */
    public function setDefaut($defaut)
    {
        $this->defaut = $defaut;
    }

    /**
     * Get defaut
     *
     * @return boolean 
     */
    public function getDefaut()
    {
        return $this->defaut;
    }
    
    public function __toString() 
    {
        return $this->getLibelle();
    }
}