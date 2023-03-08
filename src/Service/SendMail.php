<?php

namespace App\Service;

use App\Service\CreateToken;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendMail
{
    public function newPassword(MailerInterface $mailer,int $id,string $email,bool $select_action=true)
    {
        $action='Changez de mot de passe';
        if(!$select_action){
            $action="Vous n'êtes plus un administrateur";
        }
        $token=(new CreateToken($id))->generateToken();
        $mail=(new TemplatedEmail())
            ->from($_ENV['qa_email'])
            ->to($email)
            ->subject($action)
            ->htmlTemplate('./section/_newPassword.html.twig')
            ->context([
                "token"=>$token,
                "action"=>$action
            ])
        ;
        $mailer->send($mail);
    }

    public function confirmEmail(MailerInterface $mailer,int $id,string $email)
    {
        $token=(new CreateToken($id))->generateToken();
        $mail=(new TemplatedEmail())
            ->from($_ENV['qa_email'])
            ->to($email)
            ->subject("Confirmez-votre adresse e-mail")
            ->htmlTemplate('./section/_confirmEmail.html.twig')
            ->context([
                "token"=>$token
            ])
        ;
        $mailer->send($mail);
    }

    public function thankReservation(MailerInterface $mailer,array $Reservation)
    {
        $info=[
            'name'=>$Reservation['name'],
            'nbrC'=>$Reservation['couvert'],
            'nbrE'=>$Reservation['enfant'],
            'date'=>$Reservation['date'],
            'hour'=>$Reservation['hour']
        ];
        $mail=(new TemplatedEmail())
            ->from($_ENV['qa_email'])
            ->to($Reservation['email'])
            ->subject("Reservation Effectué!")
            ->htmlTemplate('./section/_thankReservation.html.twig')
            ->context([
                "info"=>$info
            ])
        ;
        $mailer->send($mail);
    }
}