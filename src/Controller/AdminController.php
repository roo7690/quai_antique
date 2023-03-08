<?php

namespace App\Controller;

use App\Repository\User\User;
use App\Repository\HoraireController\HoraireController;
use App\Repository\Qa\Galerie;
use App\Repository\User\Admin;
use App\Repository\Qa\Produit;
use App\Repository\Qa\Menu;
use App\Service\SendMail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PDO;
use Symfony\Component\Mailer\MailerInterface;

#[Route('/admin',name:'Admin')]
class AdminController extends AbstractController
{
    #[Route('/', name:'')]
    public function Admin(): Response
    {
        $admins=(new Admin())->getAdmins();

        return $this->render('admin/Admin.html.twig',[
            'Admin'=>$admins,
            "page"=>"Accueil"
        ]);
    }

    //Gestion des administrateurs
    #[Route('/add',name: '-Add')]
    public function Add(): RedirectResponse
    {
        if(isset($_POST['passwordAdmin'])){
            $pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
            //password de l'admin
            $cmd=$pdo->prepare('select password from user where id=?;');
            $cmd->bindParam(1,$_SESSION['id']);
            $cmd->execute();
            $response=$cmd->fetch(PDO::FETCH_ASSOC);
            //password send
            $password=hash('ripemd160',hash('sha1',$_POST['passwordAdmin']));

            if($password!=$response['password']){
                echo '<script>localStorage.setItem("echec","0");</script>';
            }else{
                //vérifie si cet utilisateur esxiste
                $response=(new Admin)->isUser($_POST['emailNewAdmin']);

                if($response){
                    (new Admin)->setAdmin($_POST['emailNewAdmin'],$_POST['produitNewAdmin'],$_POST['horaireNewAdmin'],$_POST['galerieNewAdmin']);
                }else{
                    throw $this->createNotFoundException('Oups! L\'email: "'.$_POST['emailNewAdmin'].'" ne possède 
                    pas un compte Quai Antique! ');
                }
            }

            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/update/{id}',name:'-Update')]
    public function Update($id,MailerInterface $Mailer): RedirectResponse
    {
        if(isset($_POST['admin-produit_'.$id])){
            if(isset($_POST['admin-delete_'.$id])){
                (new Admin)->delAdmin($id);
                //envoi l'email d'information
                $user= new User;
                $email= $user->getEmail($id);
                $user=$user->getUser($email);
                (new SendMail)->newPassword($Mailer,$user['id'],$user['email'],false);
            }else{
                $acces=[];
                if(isset($_POST['admin-produit_'.$id])){
                    $acces['produit']=1;
                }else{
                    $acces['produit']=0;
                }
                if(isset($_POST['admin-galerie_'.$id])){
                    $acces['galerie']=1;
                }else{
                    $acces['galerie']=0;
                }
                if(isset($_POST['admin-horaire_'.$id])){
                    $acces['horaire']=1;
                }else{
                    $acces['horaire']=0;
                }
                (new Admin)->updateAdmin($acces,$id);
            }

            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    //Gestion du message du jour
    #[Route('/msg',name:'-Msg')]
    public function Msg(): RedirectResponse
    {
        if(isset($_POST['textMsg'])){
            if($_FILES['fileMessage']['error']===UPLOAD_ERR_OK){
                (new Admin)->sendMsg($_FILES['fileMessage']['tmp_name'],$_POST['textMsg']);
            }else{
                throw $this->createNotFoundException("Oups! L'image n'a pas été envoyé!");
            }

            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    //Gestion de la galerie
    #[Route('/galerie/add',name:'-Galerie-Add')]
    public function AddGalerie(): RedirectResponse
    {
        if(isset($_POST['titreGalerie'])){
            if($_FILES['fileGalerie']['error']===UPLOAD_ERR_OK){
                (new Galerie($_POST['titreGalerie'],$_FILES['fileGalerie']))->setGalerie();
            }else{
                throw $this->createNotFoundException("Oups! L'image n'a pas été envoyé!");
            }

            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/galerie/update/{id}',name:'-Galerie-Update')]
    public function UpdateGalerie($id): RedirectResponse
    {
        if(isset($_POST['titreGalerie'.$id])){
            (new Galerie($_POST['titreGalerie'.$id]))->updateGalerie($id);
            
            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/galerie/delete/{id}',name:'-Galerie-Delete')]
    public function DeleteGalerie($id): RedirectResponse
    {
        if(isset($_SESSION['user']['droitNote'])){
            if(!$_SESSION['user']['droitNote']){
                (new Galerie)->delGalerie($id);

                return $this->redirectToRoute('Admin');
            }
        }
        
        return $this->redirectToRoute('Accueil');
    }

    //Gestion des produits
    #[Route('/produit/add',name:'-Produit-Add')]
    public function AddProduit(): RedirectResponse
    {
        if(isset($_POST['titreProduit'])){
            (new Produit($_POST['typeProduit'],$_POST['titreProduit'],$_POST['descriptionProduit'],$_POST['prixProduit']))->setProduit();

            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/produit/update/{id}',name:'-Produit-Update')]
    public function UpdateProduit($id): RedirectResponse
    {
        if(isset($_POST['titreProduit'.$id])){
            (new Produit('',$_POST['titreProduit'.$id],$_POST['descriptionProduit'.$id],$_POST['prixProduit'.$id]))->updateProduit($id);
            
            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/produit/delete/{id}',name:'-Produit-Delete')]
    public function DeleteProduit($id): RedirectResponse
    {
        
        if(isset($_SESSION['user']['droitNote'])){
            if(!$_SESSION['user']['droitNote']){
                (new Produit())->delProduit($id);

                return $this->redirectToRoute('Admin');
            }
        }
        
        
        return $this->redirectToRoute('Accueil');
    }

    //Gestion des menus
    #[Route('/menu/add',name:'-Menu-Add')]
    public function AddMenu(): RedirectResponse
    {
        if(isset($_POST['titreMenu'])){
            (new Menu($_POST['titreMenu'],$_POST['descriptionMenu'],$_POST['prixMenu']))->setMenu();

            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/menu/update/{id}',name:'-Menu-Update')]
    public function UpdateMenu($id): RedirectResponse
    {
        if(isset($_POST['titreMenu'.$id])){
            (new Menu($_POST['titreMenu'.$id],$_POST['descriptionMenu'.$id],$_POST['prixMenu'.$id]))->updateMenu($id);
            
            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

    #[Route('/menu/delete/{id}',name:'-Menu-Delete')]
    public function DeleteMenu($id): RedirectResponse
    {
        if(isset($_SESSION['user']['droitNote'])){
            if(!$_SESSION['user']['droitNote']){
                (new Menu())->delMenu($id);

                return $this->redirectToRoute('Admin');
            }
        }
        
        
        return $this->redirectToRoute('Accueil');
    }

    //Gestion de l'horaire
    #[Route('/horaire',name: '-Horaire')]
    public function Horaire(): RedirectResponse
    {
        if(isset($_POST['midiOpen1'])){
            $hour=[];

            for($i=1;$i<8;$i++){
               $hour[]=[
                   "midi"=>$_POST['midiOpen'.$i].'-'.$_POST['midiClose'.$i],
                   "soir"=>$_POST['soirOpen'.$i].'-'.$_POST['soirClose'.$i]
               ];
            }
            $horaire= new HoraireController;
            $horaire->changeHoraire($hour);
            $horaire->changeCreneaux();

            return $this->redirectToRoute('Admin');
        }

        return $this->redirectToRoute('Accueil');
    }

}