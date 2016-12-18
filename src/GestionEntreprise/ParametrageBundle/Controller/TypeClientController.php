<?php

namespace GestionEntreprise\ParametrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GestionEntreprise\ParametrageBundle\Entity\TypeClient;
use GestionEntreprise\ParametrageBundle\Form\TypeClientType;


class TypeClientController extends Controller
{
    
    public function listeAction()
    {
        // On récupère les types de client.
        $typesClient = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypeClient')->findAll();
        
        return $this->render('GestionEntrepriseParametrageBundle:TypeClient:liste.html.twig', array(
            'typesClient' => $typesClient
        ));

    }
    
    public function ajoutAction()
    {
        // On crée notre objet CategoriePrestation.
        $typeClient = new TypeClient();
        
        $form = $this->createForm(new TypeClientType(), $typeClient);
        
        // On récupère la requête.
        $request = $this->get('request');

        // On vérifie qu'elle est de type « POST ».
        if( $request->getMethod() == 'POST' )
        {
            // On fait le lien Requête <-> Formulaire.
            $form->bindRequest($request);

            // On vérifie que les valeurs entrées sont correctes.
            if( $form->isValid() )
            {
                // On récupère notre objet.
                $typeClient = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($typeClient);
                $em->flush();

                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeTypeClient'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:TypeClient:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    
    
    
    public function modifierAction($id)
    {
        // On récupère notre objet typeClient.
        $typeClient = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypeClient')->find($id);

        if (! $typeClient) 
        {
            throw new NotFoundHttpException('Type Client [id='.$id.'] inexistant');
        }
        
        $form = $this->createForm(new TypeClientType(), $typeClient);
        
        // On récupère la requête.
        $request = $this->get('request');

        // On vérifie qu'elle est de type « POST ».
        if( $request->getMethod() == 'POST' )
        {
            // On fait le lien Requête <-> Formulaire.
            $form->bindRequest($request);

            // On vérifie que les valeurs entrées sont correctes.
            if( $form->isValid() )
            {
                // On récupère notre objet.
                $typeClient = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($typeClient);
                $em->flush();
                
                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeTypeClient'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:TypeClient:modifier.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function supprimerAction ($id)
    {
        $entity = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypeClient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("Impossible de trouver l'entité Type Client.");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeTypeClient'));
    }
}
