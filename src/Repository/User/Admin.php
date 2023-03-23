<?php

namespace App\Repository\User;

use PDO;

class Admin extends User{
    protected bool $droitNote=false;
    /*Niveau d'administration*/
    //adminProduit, adminHoraire, adminGalerie;

    public function setAdmin(string $email,bool $adminProduit,bool $adminHoraire, bool $adminGalerie ){
        //le retrouver
        $cmd=$this->pdo->prepare("select id,password from user where email=?;");
        $cmd->bindParam(1,$email);
        $cmd->execute();
        $user=$cmd->fetch(PDO::FETCH_ASSOC);
        //initialise l' admin
        $cmd=$this->pdo->prepare("insert into admin(id_admin,produit,galerie,horaire) value (?,?,?,?);");
        $cmd->bindParam(1,$user['id']);
        $cmd->bindParam(2,$adminProduit);
        $cmd->bindParam(3,$adminGalerie);
        $cmd->bindParam(4,$adminHoraire);
        $cmd->execute();
        //change l'encodage
        $password=hash('ripemd160',$user['password']);
        $cmd=$this->pdo->prepare('update user set password=? where id=?;');
        $cmd->bindParam(1,$password);
        $cmd->bindParam(2,$user['id']);
        $cmd->execute();
    }

    public function updateAdmin(array $data,int $id)
    {
        $cmd=$this->pdo->prepare('update admin set produit=?,galerie=?,horaire=? where id_admin=?');
        $cmd->bindParam(4,$id);
        $cmd->bindParam(1,$data['produit']);
        $cmd->bindParam(2,$data['galerie']);
        $cmd->bindParam(3,$data['horaire']);
        $cmd->execute();
    }

    public function delAdmin(int $id){
        //delete
        $cmd=$this->pdo->prepare("delete from admin where id_admin=?;");
        $cmd->bindParam(1,$id);
        $cmd->execute();
        //bloque connexion
        $cmd=$this->pdo->prepare('update user set password=? where id=?;');
        $cmd->bindParam(1,"changez_votre_mot_de_passe");
        $cmd->bindParam(2,$id);
        $cmd->execute();
    }

    public function getAdmins(): array{
        $cmd=$this->pdo->prepare('select id,firstname,lastname,produit,galerie,horaire from admin inner join user where admin.id_admin=user.id;');
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendMsg(string $img,$text)
    {
        move_uploaded_file($img,'img/msg/imgMsg.jpg');

        $msg=[
            ["text"=>$text]
        ];
        $msg=json_encode($msg);
        $Msg=fopen('quaiAntique/data/msg.json','w');
        fwrite($Msg,$msg);
        fclose($Msg);
    }

}