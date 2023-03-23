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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\Type\EmailType;



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
            "reservation"=>$reservation->createView(),
            "page"=>"Accueil"
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
            "reservation"=>$reservation->createView(),
            "page"=>"Carte"
        ]);
    }

    #[Route('/form/{action}',name:'Formulaire')]
    public function Formulaire(Request $request,MailerInterface $Mailer,string $action): Response{
        //création du formulaire d'inscription ou connexion
        $form= $this->createForm(Inscrip_Connexion::class);
        $form->handleRequest($request);

        //création du formulaire de mot de passe oublié
        $forget= $this->createFormBuilder()
            ->add('email',EmailType::class, [
                'label'=>'Email',
                'attr'=>[
                    'class'=>'form'
                ]
            ])
            ->getForm();
        $forget->handleRequest($request);

        //gestion des messages de non validation
        $error='vide';

        //gestion du post de connexion ou inscription
        if($form->isSubmitted()){
            $response=null;
            if($action=='connexion'){
                $response=(new Authentification)->Connexion($form->getData());
                if(!$response){$error='Email ou mot de passe non valide';}
            }else{
                $response=(new Authentification)->Inscription($Mailer,$form->getData());
                if(!$response){$error='Cet Email est déjà utilisé';}
            }

            if($response){
                return $this->redirectToRoute('Accueil');
            }
        }

        //gestion du post de forget
        if($forget->isSubmitted()){
            $email=$forget->getData();
            $user=(new User)->getUser($email['email']);

            (new SendMail)->newPassword($Mailer,$user['id'],$user['email']);
        }

        return $this->render('admin/Form.html.twig',[
            "action"=>$action,
            "form"=>$form->createView(),
            "forget"=>$forget->createView(),
            "error"=>$error
        ]);
    }

    #[Route('/deconnexion/{page}','Deconnexion')]
    public function Deconnexion($page): RedirectResponse
    {
        $_SESSION=[];

        return $this->redirectToRoute($page);
    }

}