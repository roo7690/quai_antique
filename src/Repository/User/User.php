<?php

namespace App\Repository\User;

use PDO;

class User{
    protected PDO $pdo;
    /*info*/
    //int $id;
    private string $firstname; private string $lastname;
    private string $email; private string $password;
    /*Action*/
    /*Note*/
    protected bool $droitNote=true;/*permet de distinguer les admins de simple users mais n'est pas visible
    dans la base de données.*/
    // float $note;
    // string $msg_note;
    /*Réservation*/
    // bool $stateReservation=false;
    // int $nbr_enfant; int $nbr_couvert;
    // string $msg_reservation;

    public function __construct(string $firstname='0',string $lastname='0',string $email='0',string $password='0'){
        $this->firstname=ucfirst(strtolower($firstname));
        $this->lastname=ucfirst(strtolower($lastname));
        $this->email=$email;
        $this->password=$password;
        $this->pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
    }

    public function setUser(){
        //crée un utitlisateur
        $cmd=$this->pdo->prepare("insert into user(firstname,lastname,email,password,confirme) value (?,?,?,?,0);");
        $cmd->bindParam(1,$this->firstname);
        $cmd->bindParam(2,$this->lastname);
        $cmd->bindParam(3,$this->email);
        $cmd->bindParam(4,$this->password);
        $cmd->execute();
        //le retrouver
        $cmd=$this->pdo->prepare("select id from user where email=?;");
        $cmd->bindParam(1,$this->email);
        $cmd->execute();
        $user=$cmd->fetch(PDO::FETCH_ASSOC);
        //initialise ses actions
        $cmd=$this->pdo->prepare("insert into action(id_user,state_reservation,state_note) value (?,false,0);");
        $cmd->bindParam(1,$user['id']);
        $cmd->execute();
    }

    public function confirmUser(int $id){
        $cmd=$this->pdo->prepare('update user set confirme=true where id=?;');
        $cmd->bindParam(1,$id);
        $cmd->execute();
    }

    public function delUser(string $id){
        //retrouve l'id
        $id=substr($id,strpos($id,'_')+1);
        //supprime user
        $cmd=$this->pdo->prepare("delete from user where id=?;");
        $cmd->bindParam(1,$id);
        $cmd->execute();
        //supprime ses actions
        $cmd=$this->pdo->prepare("delete from action where id_user=?;");
        $cmd->bindParam(1,$id);
        $cmd->execute();
    }

    public function getEmail(int $id): string{
        $cmd=$this->pdo->prepare('select email from user where id=?;');
        $cmd->bindParam(1,$id);
        $cmd->execute();
        $response=$cmd->fetch(PDO::FETCH_ASSOC);

        return $response['email'];
    }

    public function getUser(string $email): array{
        $cmdSql="select id,email,firstname,lastname,state_reservation,nbr_enfant,nbr_couvert,msg_reservation,note,msg_note from user inner join action where user.email=? and user.id=action.id_user;";
        if(!$this->droitNote){
            $cmdSql="select id,email,firstname,lastname,nbr_enfant,nbr_couvert,msg_reservation,produit,galerie,horaire from user inner join action on user.id=action.id_user inner join admin on user.id=admin.id_admin where user.email=?;";
        }

        $cmd=$this->pdo->prepare($cmdSql);
        $cmd->bindParam(1,$email);
        $cmd->execute();
        $response=$cmd->fetch(PDO::FETCH_ASSOC);
        $response["droitNote"]=$this->droitNote;
        return $response;
    }

    public function getNote():array{
        function Note(float $note): array{
            $la=0;
            if((1-$note)>0.5){
                $la=1;
            }
            $cx=200-sin((1-$note)*6.28)*150;
            $cy=200-cos((1-$note)*6.28)*150;
            $arc=['note'=>round(($note)*5,1),'PA'=>$cx.' '.$cy,'LA'=>$la];
            return $arc;
        }
        $cmd=$this->pdo->prepare('select note from action where note is not null;');
        $cmd->execute();
        $Notes=$cmd->fetchAll(PDO::FETCH_ASSOC);
        $note=0;
        foreach($Notes as $item){
            $note+=$item['note'];
        }
        $note=($note/count($Notes))/5;
        return Note($note);
    }

    public function getAvis(): array{
        $cmd=$this->pdo->prepare('select firstname,lastname,msg_note from action inner join user on user.id=action.id_user order by state_note desc limit 2;');
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
}