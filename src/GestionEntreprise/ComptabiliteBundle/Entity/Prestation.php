<?php

namespace GestionEntreprise\ComptabiliteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestionEntreprise\ComptabiliteBundle\Entity\Prestation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="GestionEntreprise\ComptabiliteBundle\Entity\PrestationRepository")
 */
class Prestation
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
     * @var decimal $tarif
     *
     * @ORM\Column(name="tarif", type="decimal")
     */
    private $tarif;
    
    /**
     * @var date $date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;
    
    /**
     * @var TypePrestation $typePrestation
     *
     * @ORM\ManyToOne(targetEntity="GestionEntreprise\ParametrageBundle\Entity\TypePrestation")
     */
    private $typePrestation;
    
    /**
     * @var Client $client
     *
     * @ORM\ManyToOne(targetEntity="GestionEntreprise\ParametrageBundle\Entity\Client")
     */
    private $client;

    /**
     * @var MoyenDePaiement $moyenDePaiement
     *
     * @ORM\ManyToOne(targetEntity="GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiement")
     */
    private $moyenDePaiement;

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
     * Set tarif
     *
     * @param decimal $tarif
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * Set typePrestation
     *
     * @param TypePrestation $typePrestation
     */
    public function setTypePrestation($typePrestation)
    {
        $this->typePrestation = $typePrestation;
    }

    /**
     * Get typePrestation
     *
     * @return TypePrestation 
     */
    public function getTypePrestation()
    {
        return $this->typePrestation;
    }
    
    /**
     * Set client
     *
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Get client
     *
     * @return Client 
     */
    public function getClient()
    {
        return $this->client;
    }
    
    /**
     * Set moyenDePaiement
     *
     * @param MoyenDePaiement $moyenDePaiement
     */
    public function setMoyenDePaiement($moyenDePaiement)
    {
        $this->moyenDePaiement = $moyenDePaiement;
    }

    /**
     * Get moyenDePaiement
     *
     * @return MoyenDePaiement 
     */
    public function getMoyenDePaiement()
    {
        return $this->moyenDePaiement;
    }
    
}