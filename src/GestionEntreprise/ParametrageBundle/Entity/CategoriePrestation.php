<?php

namespace GestionEntreprise\ParametrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestionEntreprise\ParametrageBundle\Entity\CategoriePrestation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionEntreprise\ParametrageBundle\Entity\CategoriePrestationRepository")
 */
class CategoriePrestation
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
     * @var TypeClient $typeClient
     *
     * @ORM\ManyToOne(targetEntity="GestionEntreprise\ParametrageBundle\Entity\TypeClient")
     */
    private $typeClient;


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
    
    public function __toString() {
        return $this->libelle;
    }
    
}