<?php

namespace GestionEntreprise\ParametrageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Doctrine\ORM\EntityRepository;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('civilite', 'entity', array('label' => 'Civilité : ',
                                              'class' => 'GestionEntrepriseParametrageBundle:Civilite',
                                              'query_builder' => function(EntityRepository $er) {
                                                                      return $er->createQueryBuilder('u');
                                                                 },
                                              'required' => false
                                             ))
            ->add('nom', 'text', array('label' => 'Nom : ',
                                       'required' => true,
                                       ))
            ->add('prenom', 'text', array('label' => 'Prénom : ',
                                          'required' => false,
                                          ))
            ->add('telephone', 'text', array('label' => 'Téléphone : ',
                                             'required' => false,
                                             ))
            ->add('telephone2', 'text', array('label' => 'Téléphone 2 : ',
                                              'required' => false,
                                              ))
            ->add('email', 'email', array('label' => 'E-mail : ',
                                          'required' => false,
                                          ))
            ->add('adresse', new AdresseType)
        ;
    }

    public function getName()
    {
        return 'gestionentreprise_parametragebundle_clienttype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'GestionEntreprise\ParametrageBundle\Entity\Client',
        );
    }
}
