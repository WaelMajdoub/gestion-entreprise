<?php

namespace GestionEntreprise\ParametrageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestionEntreprise\ParametrageBundle\Entity\Adresse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionEntreprise\ParametrageBundle\Entity\AdresseRepository")
 */
class Adresse
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
     * @var string $libelle1
     *
     * @ORM\Column(name="libelle1", type="string", length=255)
     */
    private $libelle1;

    /**
     * @var string $libelle2
     *
     * @ORM\Column(name="libelle2", type="string", length=255, nullable=true)
     */
    private $libelle2;

    /**
     * @var integer $codePostal
     *
     * @ORM\Column(name="codePostal", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var string $ville
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;


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
     * Set libelle1
     *
     * @param string $libelle1
     */
    public function setLibelle1($libelle1)
    {
        $this->libelle1 = $libelle1;
    }

    /**
     * Get libelle1
     *
     * @return string 
     */
    public function getLibelle1()
    {
        return $this->libelle1;
    }

    /**
     * Set libelle2
     *
     * @param string $libelle2
     */
    public function setLibelle2($libelle2)
    {
        $this->libelle2 = $libelle2;
    }

    /**
     * Get libelle2
     *
     * @return string 
     */
    public function getLibelle2()
    {
        return $this->libelle2;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * Get codePostal
     *
     * @return integer 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }
}