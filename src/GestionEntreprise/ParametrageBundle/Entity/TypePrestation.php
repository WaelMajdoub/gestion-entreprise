<?php

namespace GestionEntreprise\ParametrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * GestionEntreprise\ParametrageBundle\Entity\TypePrestation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionEntreprise\ParametrageBundle\Entity\TypePrestationRepository")
 */
class TypePrestation
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
     * @ORM\Column(name="libelle", type="string", length=255, nullable=false)
     */
    private $libelle;

    /**
     * @var decimal $tarif
     *
     * @ORM\Column(name="tarif", type="decimal", nullable=false)
     */
    private $tarif;

    /**
     * @var TypeClient $typeClient
     *
     * @ORM\ManyToOne(targetEntity="GestionEntreprise\ParametrageBundle\Entity\TypeClient")
     */
    private $typeClient;
    
    /**
     * @var boolean $useProduit
     *
     * @ORM\Column(name="useProduit", type="boolean")
     */
    private $useProduit;
    
    /**
     * @var ArrayCollection $categoriesPrestation
     *
     * @ORM\ManyToMany(targetEntity="GestionEntreprise\ParametrageBundle\Entity\CategoriePrestation")
     */
    private $categoriesPrestation;

    public function __construct()
    {
        $this->categoriesPrestation = new ArrayCollection();
    }

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
     * Set tarif
     *
     * @param decimal $tarif
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }

    /**
     * Get tarif
     *
     * @return decimal 
     */
    public function getTarif()
    {
        return $this->tarif;
    }
    
    /**
     * Set typeClient
     *
     * @param TypeClient $typeClient
     */
    public function setTypeClient($typeClient)
    {
        $this->typeClient = $typeClient;
    }

    /**
     * Get typeClient
     *
     * @return TypeClient 
     */
    public function getTypeClient()
    {
        return $this->typeClient;
    }

    /**
     * Set useProduit
     *
     * @param boolean $useProduit
     */
    public function setUseProduit($useProduit)
    {
        $this->useProduit = $useProduit;
    }

    /**
     * Get useProduit
     *
     * @return boolean 
     */
    public function getUseProduit()
    {
        return $this->useProduit;
    }
    
    /**
     * Set categoriePrestation
     *
     * @param ArrayCollection $arrayCategoriePrestation
     */
    public function setCategoriesPrestation($categoriesPrestation)
    {
        $this->categoriesPrestation = $categoriesPrestation;
    }

    /**
     * Get categoriePrestation
     *
     * @return ArrayCollection
     */
    public function getCategoriesPrestation()
    {
        return $this->categoriesPrestation;
    }
    
    public function __toString() 
    {
        return $this->getLibelle();
    }
	
}