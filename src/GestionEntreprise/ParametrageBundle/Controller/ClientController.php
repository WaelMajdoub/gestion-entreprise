<?php

namespace GestionEntreprise\ParametrageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GestionEntreprise\ParametrageBundle\Entity\Client;
use GestionEntreprise\ParametrageBundle\Form\ClientType;

class ClientController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('GestionEntrepriseParametrageBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function listeAction()
    {
        // On récupère les clients.
        $clients = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Client')->findAllOrderByNom();

        return $this->render('GestionEntrepriseParametrageBundle:Client:liste.html.twig', array(
            'clients' => $clients
        ));

    }
    
    public function ajoutClientMemeAdresseAction($id)
    {
        // On crée notre objet Client.
        $client = new Client();
        
        // On récupère notre adresse.
        $client->setAdresse($this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Adresse')->find($id));
        
        $form = $this->createForm(new ClientType(), $client);
        
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
                $client = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $adresse = $client->getAdresse();
                $em-> persist($adresse);
                $em->persist($client);
                $em->flush();

                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeClient'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:Client:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function ajoutAction()
    {
        // On crée notre objet Client.
        $client = new Client();
        
        $form = $this->createForm(new ClientType(), $client);
        
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
                $client = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $adresse = $client->getAdresse();
                $em-> persist($adresse);
                $em->persist($client);
                $em->flush();

                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeClient'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:Client:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    
    
    public function modifierAction($id)
    {
        // On récupère notre objet Type Prestation.
        $client = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Client')->find($id);

        if (! $client) 
        {
            throw new NotFoundHttpException('Client [id='.$id.'] inexistant');
        }
        
        $form = $this->createForm(new ClientType(), $client);
        
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
                $client = $form->getData();

                // On l'enregistre dans la base de données.
                $em = $this->getDoctrine()->getEntityManager();
                $adresse = $client->getAdresse();
                $em-> persist($adresse);
                $em->persist($client);
                $em->flush();

                
                // On redirige vers la page d'accueil, par exemple.
                return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeClient'));
            }
        }

        // À ce stade :
        // - soit la requête est de type « GET », donc le visiteur vient d'arriver et veut voir le formulaire ;
        // - soit la requête est de type « POST », mais le formulaire n'est pas valide, donc on l'affiche de nouveau.

        return $this->render('GestionEntrepriseParametrageBundle:Client:modifier.html.twig', array(
            'form' => $form->createView(),
            'client' => $client
        ));
    }
    
    public function supprimerAction ($id)
    {
        $entity = $this->getDoctrine()->getRepository('GestionEntreprise\ParametrageBundle\Entity\Client')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException("Impossible de trouver l'entité Client.");
        }

        $em = $this->getDoctrine()->getEntityManager();
        $adresse = $entity->getAdresse();
        $em->remove($adresse);
        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('GestionEntrepriseParametrageBundle_listeClient'));
    }
}
