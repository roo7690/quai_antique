<?php

namespace App\EventListener;

use App\Repository\HoraireController\HoraireController;
use App\Repository\Qa\Galerie;
use App\Repository\Qa\Menu;
use App\Repository\Qa\Produit;
use App\Repository\User\Admin;
use App\Repository\User\User;
use PDO;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Twig\Environment;

class AddGlobalVar
{
    private $user,$twig,$path,$galerie,$produit,$menu,$horaire;

    public function __construct(Environment $twig,Galerie $galerie,Produit $produit,Menu $menu,HoraireController $horaire)
    {
        $this->twig=$twig;
        //Données
        $this->galerie=$galerie;
        $this->produit=$produit;
        $this->menu=$menu;
        $this->horaire=$horaire;
        //lien url
        $this->path=[
            "bootstrap"=>((new PathPackage('bootstrap/',new EmptyVersionStrategy()))->getUrl('')),
            "qaCss"=>((new PathPackage('quaiAntique/css/',new EmptyVersionStrategy()))->getUrl('')),
            "qaJs"=>((new PathPackage('quaiAntique/js/',new EmptyVersionStrategy()))->getUrl('')),
            "imgGalerie"=>((new PathPackage('img/galerie/',new EmptyVersionStrategy()))->getUrl('')),
            "imgMenu"=>((new PathPackage('img/menu/',new EmptyVersionStrategy()))->getUrl('')),
            "imgConstant"=>((new PathPackage('img/constant/',new EmptyVersionStrategy()))->getUrl('')),
            "Logo"=>((new PathPackage('img/',new EmptyVersionStrategy()))->getUrl('Logo.png'))
        ];
    }

    public function onKernelController()
    {
        //Détection de la connexion : gestion statut user
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['droitNote']){
                $this->user=(new User())->getUser($_SESSION['user']['email']);
            }else{
                $this->user=(new Admin())->getUser($_SESSION['user']['email']);
            }
            if(!$this->user){$_SESSION=[];}
        }else{$this->user=false;}

        $this->twig->addGlobal('user',$this->user);
        $this->twig->addGlobal('path',$this->path);
        $this->twig->addGlobal('Galerie',$this->galerie->getGaleries());
        $this->twig->addGlobal('slide',$this->galerie->getGalerie());
        $this->twig->addGlobal('Produit',$this->produit->getProduits());
        $this->twig->addGlobal('Menu',$this->menu->getMenus());
        $this->twig->addGlobal('Horaire',$this->horaire->getHoraire());

        (new HoraireController)->getCreneaux();
    }

}