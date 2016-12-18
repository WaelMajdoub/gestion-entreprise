<?php

namespace GestionEntreprise\ParametrageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MoyenDePaiementType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('libelle', 'text', array('label' => 'Libelle : ',
                                           'required' => true,
                                           ))
            ->add('defaut', 'checkbox', array('label' => 'Par défaut ? : ',
                                              'required' => false,
                                             ))
        ;
    }

    public function getName()
    {
        return 'gestionentreprise_parametragebundle_moyendepaiementtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiement',
        );
    }
}
