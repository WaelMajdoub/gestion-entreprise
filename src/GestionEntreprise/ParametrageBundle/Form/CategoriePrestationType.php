<?php

namespace GestionEntreprise\ParametrageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use GestionEntreprise\ParametrageBundle\Entity\TypeClientRepository;

class CategoriePrestationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('libelle', 'text', array('label' => 'Libelle : ',
                                           'required' => true,
                                           ))
            ->add('typeClient', 'entity', array('label' => 'Type de client : ',
                                                'class' => 'GestionEntrepriseParametrageBundle:TypeClient',
                                                'query_builder' => function(TypeClientRepository $er) {
                                                                        return $er->createQueryBuilder('u');
                                                                   }
                                               ))
        ;
    }

    public function getName()
    {
        return 'gestionentreprise_parametragebundle_categorieprestationtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'GestionEntreprise\ParametrageBundle\Entity\CategoriePrestation',
        );
    }
}
