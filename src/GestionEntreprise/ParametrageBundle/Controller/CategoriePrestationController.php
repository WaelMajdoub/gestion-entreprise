<?php

namespace GestionEntreprise\ParametrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GestionEntreprise\ParametrageBundle\Entity\CategoriePrestation;
use GestionEntreprise\ParametrageBundle\Form\CategoriePrestationType;


class CategoriePrestationController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('GestionEntrepriseParametrageBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function listeAction()
    {
        // On récupère les categories de client.
        $typesClient = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypeClient')->findAll();

        // On récupère les categorie de prestation.
        $categoriesPrestation = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\CategoriePrestation')->findAll();
        
        return $this->render('GestionEntrepriseParametrageBundle:CategoriePrestation:liste.html.twig', array(
            'typesClient' => $typesClient,
            'categoriesPrestation' => $categoriesPrestation
        ));

    }
    
    public function ajoutAction()
    {
        // On crée notre objet CategoriePrestation.
        $categoriePrestation = new CategoriePrestation();
        
        $form = $this->createForm(new CategoriePrestationType(), $categoriePrestation);
        
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
                $categoriePrestation = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($categoriePrestation);
                $em->flush();

                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeCategoriePrestation'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:CategoriePrestation:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    
    
    
    public function modifierAction($id)
    {
        // On récupère notre objet Categorie Prestation.
        $categoriePrestation = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\CategoriePrestation')->find($id);

        if (! $categoriePrestation) 
        {
            throw new NotFoundHttpException('Categorie Prestation [id='.$id.'] inexistant');
        }
        
        $form = $this->createForm(new CategoriePrestationType(), $categoriePrestation);
        
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
                $categoriePrestation = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($categoriePrestation);
                $em->flush();
                
                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeCategoriePrestation'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:CategoriePrestation:modifier.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function supprimerAction ($id)
    {
        $entity = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\CategoriePrestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("Impossible de trouver l'entité Categorie Prestation.");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeCategoriePrestation'));
    }
}
