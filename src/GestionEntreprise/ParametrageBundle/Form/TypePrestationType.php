<?php

namespace GestionEntreprise\ParametrageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\DataEvent;

use GestionEntreprise\ParametrageBundle\Entity\TypeClient;
use GestionEntreprise\ParametrageBundle\Entity\TypeClientRepository;
use GestionEntreprise\ParametrageBundle\Entity\TypePrestation;
use GestionEntreprise\ParametrageBundle\Entity\CategoriePrestationRepository;

class TypePrestationType extends AbstractType
{
    protected $logger;

    public function __construct($logger = null) 
    {
        $this->logger = $logger;
    }
    
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $factory = $builder->getFormFactory();
    
        $builder
            ->add('libelle', 'text', array('label' => 'Libelle : ',
                                           'required' => true,
                                           ))
            ->add('tarif', 'money', array('label' => 'Tarif : ',
                                          'required' => true,
                                         ))
            ->add('useProduit', 'checkbox', array('label' => 'Utilisation de produit ? : ',
                                                  'required' => false,
                                                 ))
            ->add('typeClient', 'entity', array(
                'label'     => 'Type de client : ',
                'class'     => 'GestionEntrepriseParametrageBundle:TypeClient',
                'query_builder' =>  function(TypeClientRepository $er) {
                                        return $er->createQueryBuilder('u');
                                    }));                                     
                           
        $logger = $this->logger  ;                         
        $refreshCategorie = function ($form, $typeClient) use ($factory, $logger) {
            $form->add($factory->createNamed('entity','categoriesPrestation',null, array(
                'class'         =>  'GestionEntrepriseParametrageBundle:CategoriePrestation',
                'property'      =>  'libelle',
                'label'         =>  'Catégorie',
                'query_builder' =>  function (CategoriePrestationRepository $repository) use ($typeClient) {
                                        $qb = $repository->createQueryBuilder('categoriePrestation')
                                                         ->innerJoin('categoriePrestation.typeClient', 'typeClient');
 
                                        if($typeClient instanceof TypeClient) {
                                            $qb = $qb->where('categoriePrestation.typeClient = :typeClient')
                                                     ->setParameter('typeClient', $typeClient);
                                        } elseif(is_numeric($typeClient)) {
                                            $qb = $qb->where('typeClient.id = :idTypeClient')
                                                     ->setParameter('idTypeClient', $typeClient);
                                        } else {
                                            $qb = $qb->where('typeClient.id = 1');
                                        }
                                        $qb = $qb->orderBy('categoriePrestation.libelle');

                                        return $qb;
                                    },
                'multiple' => true,
                'expanded' => true
                )));
            
        };                                   
                                               
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (DataEvent $event) use ($refreshCategorie) {
            $form = $event->getForm();
            $data = $event->getData();
 
            if($data == null)
            {
               $refreshCategorie($form, null); //As of beta2, when a form is created setData(null) is called first
            }
 
            if($data instanceof TypePrestation) 
            {
                $refreshCategorie($form, $data->getTypeClient());
            }
        });
 
        $builder->addEventListener(FormEvents::PRE_BIND, function (DataEvent $event) use ($refreshCategorie) {
            $form = $event->getForm();
            $data = $event->getData();
 
            if(array_key_exists('typeClient', $data)) 
            {
                $refreshCategorie($form, $data['typeClient']);
            }
        });
    }

    public function getName()
    {
        return 'gestionentreprise_parametragebundle_typeprestationtype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'GestionEntreprise\ParametrageBundle\Entity\TypePrestation',
        );
    }
}
