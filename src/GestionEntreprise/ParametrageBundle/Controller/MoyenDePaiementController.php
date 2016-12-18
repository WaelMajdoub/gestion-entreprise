<?php

namespace GestionEntreprise\ParametrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiement;
use GestionEntreprise\ParametrageBundle\Form\MoyenDePaiementType;


class MoyenDePaiementController extends Controller
{
    
    public function listeAction()
    {
        // On récupère les civilités
        $moyensdepaiement = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiement')->findAll();
        
        return $this->render('GestionEntrepriseParametrageBundle:MoyenDePaiement:liste.html.twig', array(
            'moyensdepaiement' => $moyensdepaiement
        ));

    }
    
    public function ajoutAction()
    {
        // On crée notre objet MoyenDePaiement.
        $moyendepaiement = new MoyenDePaiement();
        
        $form = $this->createForm(new MoyenDePaiementType(), $moyendepaiement);
        
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
                $moyendepaiement = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($moyendepaiement);
                $em->flush();

                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeMoyenDePaiement'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:MoyenDePaiement:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    
    
    
    public function modifierAction($id)
    {
        // On récupère notre objet moyendepaiement.
        $moyendepaiement = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiement')->find($id);

        if (! $moyendepaiement) 
        {
            throw new NotFoundHttpException('Moyen de paiement [id='.$id.'] inexistant');
        }
        
        $form = $this->createForm(new MoyenDePaiementType(), $moyendepaiement);
        
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
                $moyendepaiement = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($moyendepaiement);
                $em->flush();
                
                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeMoyenDePaiement'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:MoyenDePaiement:modifier.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function supprimerAction ($id)
    {
        $entity = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\MoyenDePaiement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("Impossible de trouver l'entité MoyenDePaiement.");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeMoyenDePaiement'));
    }
}
