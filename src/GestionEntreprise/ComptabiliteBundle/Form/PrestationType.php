<?php

namespace GestionEntreprise\ComptabiliteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\DataEvent;

use GestionEntreprise\ParametrageBundle\Entity\TypePrestation;
use GestionEntreprise\ParametrageBundle\Entity\TypePrestationRepository;
use GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiement;
use GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiementRepository;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $factory = $builder->getFormFactory();
    
        $builder
            ->add('date', 'date', array('label' => 'Date : ',
                                        'required' => true,
                                        'input'  => 'datetime',
                                        'widget' => 'single_text',
                                        'format' => 'dd/MM/yyyy'
                                       ))
            ->add('tarif', 'money', array('label' => 'Tarif : ',
                                          'required' => true,
                                         ))
            ->add('client', 'search', array('label' => 'Client : ',
                                          'required' => true,
                                         ))
            ->add('moyenDePaiement', 'entity', array(
                'label'     => 'Moyen de paiement : ',
                'class'     => 'GestionEntrepriseParametrageBundle:MoyenDePaiement',
                'required' => true,
                'empty_value'   => '',
                'query_builder' =>  function(MoyenDePaiementRepository $er) {
                                        return $er->createQueryBuilder('u');
                                    }))
            ->add('typePrestation', 'entity', array(
                'label'     => 'Type de prestation : ',
                'class'     => 'GestionEntrepriseParametrageBundle:TypePrestation',
                'required' => true,
                'empty_value'   => '',
                'query_builder' =>  function(TypePrestationRepository $er) {
                                        return $er->createQueryBuilder('u');
                                    }))
            
                                   ;                                     
    }

    public function getName()
    {
        return 'gestionentreprise_comptabilitebundle_prestationtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'GestionEntreprise\ComptabiliteBundle\Entity\Prestation',
        );
    }
}
