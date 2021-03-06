<?php

namespace GestionEntreprise\ParametrageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CiviliteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('libelle', 'text', array('label' => 'Libelle : ',
                                           'required' => true,
                                           ))
        ;
    }

    public function getName()
    {
        return 'gestionentreprise_parametragebundle_civilitetype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'GestionEntreprise\ParametrageBundle\Entity\Civilite',
        );
    }
}
