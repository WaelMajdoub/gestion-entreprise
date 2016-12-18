<?php

namespace GestionEntreprise\ComptabiliteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GestionEntreprise\ComptabiliteBundle\Entity\Prestation;
use GestionEntreprise\ComptabiliteBundle\Form\PrestationType;

use GestionEntreprise\ParametrageBundle\Entity\TypePrestation;
use GestionEntreprise\ParametrageBundle\Entity\Client;

use Symfony\Component\HttpFoundation\Response;

class PrestationController extends Controller
{
    public function selectClientAction()
    {
        $logger = $this->get('logger');
        $logger->debug('selectClientAction');

        $clients = array();
        
        $request = $this->container->get('request');

        if($request->isXmlHttpRequest())
        {
            $nameWith = '';
            $nameWith = $request->request->get('nameWith');
            
            $logger->debug("nameWith=".$nameWith);
            $clients = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Client')
                ->findByNameWith($nameWith);
        }
 
        //JSON Serialize Save Object System
        $logger->debug('Sérialisation JSON');
        $serializer = $this->get('serializer');
        $json = $serializer->serialize($clients, 'json');
        $logger->debug($json);
        
        // Pour la suite voir : http://blog.azancadas.com/2011/07/dynamically-populate-select-box/
        // http://blog.azancadas.com/2011/08/symfony2-dynamic-forms-an-event-driven-approach/
        
        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
    public function selectTypePrestationAction()
    {
        $logger = $this->get('logger');
        $logger->debug('selectTypePrestationAction');

        $typePrestation = null;
        
        $request = $this->container->get('request');

        if($request->isXmlHttpRequest())
        {
            $idTypePrestation = '';
            $idTypePrestation = $request->request->get('idTypePrestation');
            
            $logger->debug("idTypePrestation=".$idTypePrestation);
            $typePrestation = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\TypePrestation')
                ->find($idTypePrestation);
        }
        
 
        //JSON Serialize Save Object System
        $logger->debug('Sérialisation JSON');
        $serializer = $this->get('serializer');
        $json = $serializer->serialize($typePrestation, 'json');
        $logger->debug($json);
        
        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    public function listeAction()
    {
        // On récupère les civilités
        $prestations = $this->getDoctrine()->getRepository('GestionEntreprise\ComptabiliteBundle\Entity\Prestation')->findAll();
        
        return $this->render('GestionEntrepriseComptabiliteBundle:Prestation:liste.html.twig', array(
            'prestations' => $prestations
        ));
        

    }
    
    public function ajoutAction()
    {
        $logger = $this->get('logger');
        $logger->debug('ajoutPrestationAction');
        
        // On crée notre objet prestation.
        $prestation = new Prestation();
        
        $form = $this->createForm(new PrestationType(), $prestation);
        
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
                $prestation = $form->getData();

                
                $idClient = $prestation->getClient();
                $logger->debug($idClient);
                $client = new Client();
                $client = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Client')
                    ->find($idClient);
                $logger->debug($client->getPrenom());
                
                
                $prestation->setClient($client);
                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($prestation);
                $em->flush();
                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseComptabiliteBundle_listePrestation'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseComptabiliteBundle:Prestation:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    
    
    public function modifierAction($id)
    {
        $logger = $this->get('logger');
        
        // On récupère notre objet prestation.
        $prestation = $this->getDoctrine()->getRepository('GestionEntreprise\ComptabiliteBundle\Entity\Prestation')->find($id);

        if (! $prestation) 
        {
            throw new NotFoundHttpException('Prestation [id='.$id.'] inexistant');
        }
        
        $form = $this->createForm(new PrestationType($logger), $prestation);
        
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
                $prestation = $form->getData();

                $idClient = $prestation->getClient();
                $logger->debug($idClient);
                $client = new Client();
                $client = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Client')
                    ->find($idClient);
                $logger->debug($client->getPrenom());
                
                
                $prestation->setClient($client);
                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($prestation);
                $em->flush();
                
                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseComptabiliteBundle_listePrestation'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseComptabiliteBundle:Prestation:modifier.html.twig', array(
            'form' => $form->createView(),
            'prestation' => $prestation
        ));
    }
    
    public function supprimerAction ($id)
    {
        $entity = $this->getDoctrine()->getRepository('GestionEntreprise\ComptabiliteBundle\Entity\Prestation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("Impossible de trouver l'entité Prestation.");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('GestionEntrepriseComptabiliteBundle_listePrestation'));
    }
}
