<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\User\User;

#[Route('/user',name:'User-Action')]
class ActionController extends AbstractController
{
    #[Route('/note/{id}',name:'User-Note')]
    public function Note($id): RedirectResponse
    {
        if(isset($_POST['note'])){
            $data=[
                "note"=>$_POST["note"],
                "msg_user"=>$_POST["msg_user"]
            ];
            (new User)->setNote($data,$id);
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/update/{id}',name:'User-Update')]
    public function Update($id): RedirectResponse
    {
        if(isset($_POST['updateUser_firstname'])){
            $data=[
                'updateUser_firstname'=>$_POST['updateUser_firstname'],
                'updateUser_lastname'=>$_POST['updateUser_lastname']
            ];
            (new User)->updateUser($data,$id);

            return $this->redirectToRoute($_GET['page']);
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/delete/{id}',name:'User-Delete')]
    public function Delete($id): RedirectResponse
    {
        if(isset($_SESSION)){
            if(isset($_SESSION['id'])){
                if($id==$_SESSION['id']){
                    (new User)->delUser($id);
    
                    return $this->redirectToRoute($_GET['page']);
                }
            } 
        }

        return $this->redirectToRoute('Accueil');
    }

}