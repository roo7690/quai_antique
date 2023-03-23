<?php

namespace App\Controller;

use App\Form\Inscrip_Connexion;
use App\Repository\User\User;
use App\Service\CreateToken;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController 
{
    #[Route('/verifyToken/{token}',name:'VerifyEmail')]
    public function VerifyEmail($token, CreateToken $ctk, User $user): RedirectResponse
    {
        if($ctk->isValid($token)){
            $user_id=$ctk->getId($token);
            $user->confirmUser($user_id);
        }else{
            throw $this->createNotFoundException("Votre clé n'est plus valide!");
        }
        if(!isset($_SESSION)){
            session_start();
        }
        $email=$user->getEmail($user_id);
        $_SESSION['user']=$user->getUser($email);

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/updateAccess/{token}',name:'UpdateAcces')]
    public function UpdateAcces(Request $request,$token, CreateToken $ctk, User $user): Response
    {
        $form= $this->createForm(Inscrip_Connexion::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $data=$form->getData();
            $user->updateAccess($data['email'],$data['password']);

            return $this->redirectToRoute('Formulaire',['action'=>'connexion']);
        }else{
            if($ctk->isValid($token)){
                $user_id=$ctk->getId($token);
                $email= $user->getEmail($user_id);

                return $this->render('admin/updateAccess.html.twig',[
                    'email'=>$email,
                    "form"=>$form->createView()
                ]);
            }else{
                throw $this->createNotFoundException("Votre clé n'est plus valide!");
            }
        }
    }

}