<?php

namespace GestionEntreprise\ParametrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GestionEntreprise\ParametrageBundle\Entity\TypePrestation;
use GestionEntreprise\ParametrageBundle\Form\TypePrestationType;

use Symfony\Component\HttpFoundation\Response;

class TypePrestationController extends Controller
{

    public function selectTypeClientAction()
    {
        $logger = $this->get('logger');
        $logger->debug('selectTypeClientAction');

        $categoriesPrestation = array();
        
        $request = $this->container->get('request');

        if($request->isXmlHttpRequest())
        {
            $idTypeClient = '';
            $idTypeClient = $request->request->get('idTypeClient');
            
            $logger->debug("idTypeClient=".$idTypeClient);
            $typeClient = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypeClient')
                -> find($idTypeClient);
            $categoriesPrestation = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\CategoriePrestation')
                ->getByTypeClient($typeClient);
        }
 
        /*$html = '';
        foreach($categoriesPrestation as $categoriePrestation)
        {
            $html = $html . sprintf("<option value=\"%d\">%s</option>",$categoriePrestation->getId(), $categoriePrestation->getLibelle());
        }
        $logger->debug("html=".$html);
        return new Response($html);*/
 
 
        //JSON Serialize Save Object System
        $logger->debug('Sérialisation JSON');
        $serializer = $this->get('serializer');
        $json = $serializer->serialize($categoriesPrestation, 'json');
        $logger->debug($json);
        
        // Pour la suite voir : http://blog.azancadas.com/2011/07/dynamically-populate-select-box/
        // http://blog.azancadas.com/2011/08/symfony2-dynamic-forms-an-event-driven-approach/
        
        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    public function indexAction($name)
    {
        return $this->render('GestionEntrepriseParametrageBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function listeAction()
    {
        // On récupère les types de client.
        $typesClient = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypeClient')->findAll();

        // On récupère les types de prestation.
        $typesPrestation = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypePrestation')->findAll();
        
        return $this->render('GestionEntrepriseParametrageBundle:TypePrestation:liste.html.twig', array(
            'typesClient' => $typesClient,
            'typesPrestation' => $typesPrestation
        ));

    }
    
    public function ajoutAction()
    {
        $logger = $this->get('logger');
        
        // On crée notre objet TypePrestation.
        $typePrestation = new TypePrestation();
        
        $form = $this->createForm(new TypePrestationType($logger), $typePrestation);
        
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
                $typePrestation = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($typePrestation);
                $em->flush();

                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeTypesPrestation'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:TypePrestation:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));

    }
    
    
    
    public function modifierAction($id)
    {
        $logger = $this->get('logger');
        
        // On récupère notre objet Type Prestation.
        $typePrestation = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypePrestation')->find($id);

        if (! $typePrestation) 
        {
            throw new NotFoundHttpException('Type Prestation [id='.$id.'] inexistant');
        }
        
        $form = $this->createForm(new TypePrestationType($logger), $typePrestation);
        
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
                $typePrestation = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($typePrestation);
                $em->flush();
                
                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeTypesPrestation'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:TypePrestation:modifier.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function supprimerAction ($id)
    {
        $entity = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypePrestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("Impossible de trouver l'entité Type Prestation.");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeTypesPrestation'));
    }
}
