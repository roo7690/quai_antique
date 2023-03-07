<?php

namespace App\Repository\Reservation;

use PDO;

class Reservation{
    private PDO $pdo;

    public function __construct(){
        $this->pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
    }

    public function reserver(array $info){
        //retrouver le nombre de reservation
        $cmd=$this->pdo->prepare('select reserver from creneau where week=? and horaire=?');
        $cmd->bindParam(1,$info['jour']);
        $cmd->bindParam(2,$info['hour']);
        $cmd->execute();
        $nbrReserv=$cmd->fetch(PDO::FETCH_ASSOC);
        $nbrReserv=$nbrReserv['reserver']+1;

        //actualiser
        $cmd=$this->pdo->prepare('update creneau set reserver=? where week=? and horaire=?');
        $cmd->bindParam(1,$nbrReserv);
        $cmd->bindParam(2,$info['jour']);
        $cmd->bindParam(3,$info['hour']);
        $cmd->execute();

        //Reservation réussi
        echo "<script>localStorage.setItem('reserver','success');</script>";
    }
}