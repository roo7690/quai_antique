<?php

namespace App\Controller;

use App\Form\Inscrip_Connexion;
use App\Form\Reserver;
use App\Service\SendMail;
use App\Repository\Authentification\Authentification;
use App\Repository\HoraireController\HoraireController;
use App\Repository\Reservation\Reservation;
use App\Repository\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends AbstractController
{
    #[Route('/',name:'Accueil')]
    public function Accueil(Request $request,MailerInterface $Mailer): Response
    {
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

        return $this->render('home/Accueil.html.twig',[
            "arc"=>$arc,
            "Avis"=>$Avis,
            "reservation"=>$reservation->createView()
        ]);
    }

    #[Route('/carte',name:'Carte')]
    public function Carte(Request $request,MailerInterface $Mailer): Response
    {
        //réservation
        $reservation=$this->createForm(Reserver::class);
        $reservation->handleRequest($request);

        if($reservation->isSubmitted()){
            $info=$reservation->getData();
            (new sendMail)->thankReservation($Mailer,$info);
            (new Reservation)->reserver($info);
            (new HoraireController)->getCreneaux();
        }

        return $this->render('home/Carte.html.twig',[
            "reservation"=>$reservation->createView()
        ]);
    }

    #[Route('/form/{action}',name:'Formulaire')]
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

        return $this->render('admin/Form.html.twig',[
            "action"=>$action,
            "form"=>$form->createView(),
            "error"=>$error
        ]);
    }
}