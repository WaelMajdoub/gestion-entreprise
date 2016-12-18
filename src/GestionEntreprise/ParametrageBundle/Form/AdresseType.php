<?php

namespace GestionEntreprise\ParametrageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('libelle1', 'text', array('label' => 'Libelle 1 : ',
                                       'required' => true,
                                       ))
            ->add('libelle2', 'text', array('label' => 'Libelle 2 : ',
                                          'required' => false,
                                          ))
            ->add('codePostal', 'text', array('label' => 'Code postal : ',
                                             'required' => false,
                                             ))
            ->add('ville', 'text', array('label' => 'Ville : ',
                                              'required' => true,
                                              ))
        ;
    }

    public function getName()
    {
        return 'gestionentreprise_parametragebundle_adressetype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'GestionEntreprise\ParametrageBundle\Entity\Adresse',
        );
    }
}
