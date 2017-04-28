<?php
/**
 * Created by PhpStorm.
 * User: jeanc_000
 * Date: 15/04/2017
 * Time: 16:08
 */

namespace MariageBundle\Controller;

use MariageBundle\Entity\Passager;
use MariageBundle\Entity\Trajet;
use MariageBundle\Entity\Voiture;
use MariageBundle\Utils\ApplicationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

class LiftSharingController extends Controller
{
    public function getTrajets()
    {
        try
        {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MariageBundle:Trajet');
            $trajetsProposes = $repository->getTrajetsProposes();
            $trajetsDemandes = $repository->getTrajetsDemandes();

        }
        catch (Exception $e)
        {
            $trajetsProposes = null;
            $trajetsDemandes = null;
            error_log($e->getMessage());
        }
        finally
        {
            $trajets = [$trajetsProposes, $trajetsDemandes];
        }
        return $trajets;
    }

    public function indexAction()
    {
       $trajets = $this->getTrajets();
       $trajetsProposes = $trajets[0];
       $trajetsDemandes = $trajets[1];

            return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                ['trajets_proposes' => $trajetsProposes,
                    'trajets_demandes' => $trajetsDemandes]);
    }

    public function addAction()
    {

        if(isset($_POST['validation_ajout']))
        {
            if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['type_trajet'])
                    || empty($_POST['origine']) || empty($_POST['date']) || empty($_POST['nb_places']))
            {
                $message = '<div class="message_erreur"><p><strong>Erreur</strong> : ' .
                            'tous les champs (excepté le téléphone) son obligatoires.</p></div>';
                return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                    ['message_ajout' => $message,
                        'formulaire_ajout' => true]
                );
            }
            else
            {
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $typeTrajet = $_POST['type_trajet'];
                $origine = $_POST['origine'];
                $nbPlaces = intval($_POST['nb_places']);
                $tel = null;
                $dateDepart = null;
                $dateRetour = null;
                $estAller = true;
                if(!empty($_POST['tel']))
                {
                    $tel = $_POST['tel'];
                }
                switch ($typeTrajet){
                    case 'aller':
                        $dateDepart = $_POST['date'];
                        $estAller = true;
                        break;
                    case 'retour':
                        $dateDepart= $_POST['date'];
                        $estAller = false;
                        break;
                }
                try {
                    $em = $this->getDoctrine()->getManager();
                    $voiture = new Voiture(0, $nom, $email, $tel, $nbPlaces);
                    $em->persist($voiture);
                    $em->flush();
                    $trajet = new Trajet(0, $origine, $dateDepart, $estAller, $voiture, null);
                    $em->persist($trajet);
                    $em->flush();

                    $message = '<div class="message_succes"><p><strong>Merci!</strong> Votre proposition de covoiturage a bien été prise en compte.</p></div>';
                    $ajoutOk = true;
                }
                catch (ApplicationException $ae) {
                    $message = '<div class="message_erreur"><p><strong>Erreur</strong> : ' . $ae->getMessage() . '</p></div>';
                    $ajoutOk = false;
                }
                finally{
                    if($ajoutOk){
                        $trajets = $this->getTrajets();
                        $trajetsProposes = $trajets[0];
                        $trajetsDemandes = $trajets[1];

                        return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                            ['message_ajout' => $message,
                                'trajets_proposes' => $trajetsProposes,
                                'trajets_demandes' => $trajetsDemandes]);
                    }
                    else{
                        return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                            ['message_ajout' => $message,
                                'formulaire_ajout' => true]);
                    }
                }
            }
        }
        else{
            return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                ['formulaire_ajout' => true]
            );
        }
    }

    public function askAction() {
        if(isset($_POST['validation_demande']))
        {
            if(empty($_POST['nom']) || empty($_POST['email']) || empty($_POST['type_trajet'])
                || empty($_POST['origine']) || empty($_POST['date']) || empty($_POST['nb_places']))
            {
                $message = '<div class="message_erreur"><p><strong>Erreur</strong> : ' .
                    'tous les champs (excepté le téléphone) son obligatoires.</p></div>';
                return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                    ['message_demande' => $message,
                        'formulaire_demande' => true]
                );
            }
            else
            {
                $nom = $_POST['nom'];
                $email = $_POST['email'];
                $typeTrajet = $_POST['type_trajet'];
                $origine = $_POST['origine'];
                $nbPlaces = intval($_POST['nb_places']);
                $tel = null;
                $dateDepart = null;
                $estAller = true;
                if(!empty($_POST['tel']))
                {
                    $tel = $_POST['tel'];
                }
                switch ($typeTrajet){
                    case 'aller':
                        $dateDepart = $_POST['date'];
                        $estAller = true;
                        break;
                    case 'retour':
                        $dateDepart= $_POST['date'];
                        $estAller = false;
                        break;
                }
                try {
                    $em = $this->getDoctrine()->getManager();
                    $passager = new Passager(0, $nom, $email, $tel, $nbPlaces);
                    $em->persist($passager);
                    $em->flush();
                    $trajet = new Trajet(0, $origine, $dateDepart, $estAller, null, $passager);
                    $em->persist($trajet);
                    $em->flush();

                    $message = '<div class="message_succes"><p><strong>Merci!</strong> Votre demande de covoiturage a bien été prise en compte.</p></div>';
                    $ajoutOk = true;
                }
                catch (ApplicationException $ae) {
                    $message = '<div class="message_erreur"><p><strong>Erreur</strong> : ' . $ae->getMessage() . '</p></div>';
                    $ajoutOk = false;
                }
                finally{
                    if($ajoutOk){
                        $trajets = $this->getTrajets();
                        $trajetsProposes = $trajets[0];
                        $trajetsDemandes = $trajets[1];

                        return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                            ['message_ajout' => $message,
                                'trajets_proposes' => $trajetsProposes,
                                'trajets_demandes' => $trajetsDemandes]);
                    }
                    else{
                        return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                            ['message_ajout' => $message,
                                'formulaire_ajout' => true]);
                    }
                }
            }
        }
        else{
            return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                ['formulaire_demande' => true]
            );
        }
    }

    public function candidateAction() {
        if(isset($_POST['demander_covoit']))
        {
            $nbPlaces = $_POST['placesDemandees'];
            $idTrajet = $_POST['id_trajet'];
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MariageBundle:Trajet');
            $trajet = $repository->find($idTrajet);

            return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                ['formulaire_candidat' => true,
                    'nb_places' => $nbPlaces,
                    'trajet' => $trajet]
            );
        }
        elseif(isset($_POST['validation_candidat_covoit']))
        {
            if(empty($_POST['nom']) || empty($_POST['email']))
            {
                $message = '<div class="message_erreur"><p><strong>Erreur</strong> : ' .
                    'tous les champs (excepté le téléphone) son obligatoires.</p></div>';
                return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                    ['message_candidat' => $message,
                        'formulaire_candidat' => true]
                );
            }
            else {
                $ajoutOk = false;

                try {
                    $nom = $_POST['nom'];
                    $mail = $_POST['email'];
                    $nbPlaces = $_POST['nb_places'];
                    if (empty($_POST['tel'])) {
                        $tel = null;
                    } else {
                        $tel = $_POST['tel'];
                    }
                    $em = $this->getDoctrine()->getManager();
                    $repository = $em->getRepository('MariageBundle:Trajet');
                    $trajet = $repository->find($_POST['id_trajet']);
                    $contenu = 'Bonjour, \r\n' . $nom . ' souhaite réserver ' . $nbPlaces . ' place(s) dans votre voiture pour le trajet du ' .
                        $trajet->getDateDepart() . '. Voici ses coordonnées pour vous organiser : \r\n' . $mail;
                    if ($tel != null) {
                        $contenu .= ' - ' . $tel;
                    }

                    $courriel = \Swift_Message::newInstance()
                        ->setSubject('Demande de covoiturage')
                        ->setFrom($mail)
                        ->setTo($trajet->getVoiture()->getMail())
                        ->setBody($contenu);
                    $this->get('mailer')->send($courriel);

                    $message = '<div class="message_succes"><p><strong>Merci!</strong> Votre demande a bien été prise en compte.</p></div>';
                    $ajoutOk = true;
                } catch (Exception $ae) {
                    $message = '<div class="message_erreur"><p><strong>Erreur</strong> : ' . $ae->getMessage() . '</p></div>';
                    $ajoutOk = false;
                } finally {
                    if ($ajoutOk) {
                        $trajets = $this->getTrajets();
                        $trajetsProposes = $trajets[0];
                        $trajetsDemandes = $trajets[1];

                        return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                            ['message_demande_covoit' => $message,
                                'trajets_proposes' => $trajetsProposes,
                                'trajets_demandes' => $trajetsDemandes]);
                    } else {
                        return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                            ['message_demande_covoit' => $message,
                                'formulaire_candidat' => true]);
                    }
                }
            }
        }
        else
        {
            $trajets = $this->getTrajets();
            $trajetsProposes = $trajets[0];
            $trajetsDemandes = $trajets[1];

            $message = '<div class="message_erreur"><p><strong>Erreur</strong> : l\'email n\'a pas pu être envoyé.</p></div>';

            return $this->render('MariageBundle:Default:lift-sharing.html.twig',
                ['message_demande_covoit' => $message,
                    'trajets_proposes' => $trajetsProposes,
                    'trajets_demandes' => $trajetsDemandes]);
        }
    }
}