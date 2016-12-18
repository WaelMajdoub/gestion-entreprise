<?php

namespace GestionEntreprise\ParametrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GestionEntreprise\ParametrageBundle\Entity\Civilite;
use GestionEntreprise\ParametrageBundle\Form\CiviliteType;


class CiviliteController extends Controller
{
    
    public function listeAction()
    {
        // On récupère les civilités
        $civilites = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Civilite')->findAll();
        
        return $this->render('GestionEntrepriseParametrageBundle:Civilite:liste.html.twig', array(
            'civilites' => $civilites
        ));

    }
    
    public function ajoutAction()
    {
        // On crée notre objet Civilite.
        $civilite = new Civilite();
        
        $form = $this->createForm(new CiviliteType(), $civilite);
        
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
                $civilite = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($civilite);
                $em->flush();

                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeCivilite'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:Civilite:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    
    
    
    public function modifierAction($id)
    {
        // On récupère notre objet civilite.
        $civilite = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Civilite')->find($id);

        if (! $civilite) 
        {
            throw new NotFoundHttpException('Civilite [id='.$id.'] inexistant');
        }
        
        $form = $this->createForm(new CiviliteType(), $civilite);
        
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
                $civilite = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($civilite);
                $em->flush();
                
                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeCivilite'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:Civilite:modifier.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function supprimerAction ($id)
    {
        $entity = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Civilite')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("Impossible de trouver l'entité Civlite.");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeCivilite'));
    }
}
