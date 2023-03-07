<?php

namespace App\Controller;

use App\Repository\User\User;
use App\Service\CreateToken;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController {

    public function VerifyEmail($token, CreateToken $ctk, User $user): Response{

        if($ctk->isValid($token)){
            $user_id=$ctk->getId($token);
            (new User)->confirmUser($user_id);
        }else{
            return $this->redirectToRoute('Formulaire',['action'=>'inscription']);
        }
        if(!isset($_SESSION)){
            session_start();
        }
        $email=$user->getEmail($user_id);
        $_SESSION['user']=$user->getUser($email);

        return $this->redirectToRoute('Accueil');
    }
}