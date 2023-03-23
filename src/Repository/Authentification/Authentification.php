<?php

namespace App\Repository\Authentification;

use App\Service\SendMail;
use App\Repository\User\Admin;
use App\Repository\User\User;
use PDO;
use Symfony\Component\Mailer\MailerInterface;

class Authentification
{
    private PDO $pdo;
    private $hasherUser='sha1';
    private $hasherAdmin='ripemd160';

    public function __construct(){
        $this->pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
    }

    public function Connexion(array $data): bool
    {
        $cmd=$this->pdo->prepare("select email,password from user where email=?;");
        $cmd->bindParam(1,$data['email']);
        $cmd->execute();
        $result=$cmd->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            return false;
        }else{
            $user=null;
            $password=[
                0=>hash($this->hasherUser,$data['password']),
                1=>hash($this->hasherAdmin,hash($this->hasherUser,$data['password']))
            ];
            if($password[0]==$result['password']){
                $user=(new User())->getUser($data['email']);
            }elseif($password[1]==$result['password']){
                $user=(new Admin())->getUser($data['email']);
            }else{
                return false;
            }
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['user']=$user;
        }
        return true;
    }

    public function Inscription(MailerInterface $Mailer,array $data): bool
    {
        $cmd=$this->pdo->prepare("select email,password from user where email=?;");
        $cmd->bindParam(1,$data['email']);
        $cmd->execute();
        $result=$cmd->fetch(PDO::FETCH_ASSOC);
        if($result){
            return false;
        }else{
            $password=hash($this->hasherUser,$data['password']);
            $user=new User($data['firstname'],$data['lastname'],$data['email'],$password);
            $user->setUser();
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['user']=$user->getUser($data['email']);
            (new SendMail)->confirmEmail($Mailer,$_SESSION['user']['id'],$data["email"]);
        }
        return true;
    }

}