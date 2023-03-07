<?php

namespace App\Controller;

use App\Form\Inscrip_Connexion;
use App\Form\Reserver;
use App\Mailer\SendMail;
use App\Repository\Authentification\Authentification;
use App\Repository\HoraireController\HoraireController;
use App\Repository\Reservation\Reservation;
use App\Repository\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;


class DefaultController extends AbstractController{

    public function Accueil(Request $request,MailerInterface $Mailer): Response{

        //récupération des avis
        $info=new User();
        $arc=$info->getNote();
        $Avis=$info->getAvis();

        //réservation
        $reservation=$this->createForm(Reserver::class);
        $reservation->handleRequest($request);

        if($reservation->isSubmitted()){
            $info=$reservation->getData();
            (new sendMail)->thankReservation($Mailer,$info);
            (new Reservation)->reserver($info);
            (new HoraireController)->getCreneaux();
        }

        return $this->render('pagesPrincipales/Accueil.html.twig',[
            "arc"=>$arc,
            "Avis"=>$Avis,
            "reservation"=>$reservation->createView()
        ]);
    }

    public function Carte(Request $request,MailerInterface $Mailer): Response{

        //réservation
        $reservation=$this->createForm(Reserver::class);
        $reservation->handleRequest($request);

        if($reservation->isSubmitted()){
            $info=$reservation->getData();
            (new sendMail)->thankReservation($Mailer,$info);
            (new Reservation)->reserver($info);
            (new HoraireController)->getCreneaux();
        }

        return $this->render('pagesPrincipales/Carte.html.twig',[
            "reservation"=>$reservation->createView()
        ]);
    }

    public function Formulaire(Request $request,MailerInterface $Mailer,string $action): Response{
        //création du formulaire
        $form= $this->createForm(Inscrip_Connexion::class);
        $form->handleRequest($request);
        //gestion du post
        if($form->isSubmitted()){
            if($action=='connexion'){
                (new Authentification)->Connexion($form->getData());
            }else{
                (new Authentification)->Inscription($Mailer,$form->getData());
            }

            return $this->redirectToRoute('Accueil');
        }

        //gestion des messages de non validation
        $error=['Email ou mot de passe non valide','Cet Email est déjà utilisé'];
        if(isset($_GET['error'])){
            $error=$error[$_GET['error']];
        }else{
            $error='vide';
        }

        return $this->render('Administration/Form.html.twig',[
            "action"=>$action,
            "form"=>$form->createView(),
            "error"=>$error
        ]);
    }
}