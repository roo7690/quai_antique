<?php

namespace App\Repository\HoraireController;

use PDO;

class HoraireController{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
    }

    public function getHoraire(): array
    {
        //["date"=>"...","midi"=>"...","soir"=>"..."]
        $cmd=$this->pdo->prepare('select date,midi,soir,ordre from horaire order by ordre;');
        $cmd->execute();
        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeHoraire(array $hour)
    {
        //changer les horaires
        for($date=1; $date<8; $date++){
            $cmd=$this->pdo->prepare('update horaire set midi=?, soir=? where ordre=?;');
            $cmd->bindParam(3,$date);
            $cmd->bindParam(1,$hour[$date-1]['midi']);
            $cmd->bindParam(2,$hour[$date-1]['soir']);
            $cmd->execute();
        }
    }
    public function changeCreneaux()
    {
        //changer les créneaux de réservation
        //supprimer les creneaux actuelles
        $cmd=$this->pdo->prepare('delete from creneau;');
        $cmd->execute();
        //Création des nouveaux creneaux
        for($week=0;$week<2;$week++){
            for($i=1;$i<8;$i++){
                $this->setCreneaux($i,false,$week*7+$i);
            }
        }
    }

    public function setCreneaux(int $date,bool $DeleteJourActuel,int $week=15)
    {
        //récupérer l'horaire du jour
        $cmd=$this->pdo->prepare('select midi,soir from horaire where ordre=?;');
        $cmd->bindParam(1,$date);
        $cmd->execute();
        $horaire=$cmd->fetch(PDO::FETCH_ASSOC);
        //transformation des strings horaire en données utilisables
        $hour=[
            'midi'=>[
                'hopen'=>intval(substr($horaire['midi'],0,2)),
                'minopen'=>intval(substr($horaire['midi'],3,2)),
                'hclose'=>intval(substr($horaire['midi'],6,2)),
                'minclose'=>intval(substr($horaire['midi'],9,2))
            ],
            'soir'=>[
                'hopen'=>intval(substr($horaire['soir'],0,2)),
                'minopen'=>intval(substr($horaire['soir'],3,2)),
                'hclose'=>intval(substr($horaire['soir'],6,2)),
                'minclose'=>intval(substr($horaire['soir'],9,2))
            ]
        ];
        //creation des creneaux
        $Creneaux=$this->createCreneaux($hour);
        foreach ($Creneaux as $item){
            $cmd=$this->pdo->prepare('insert into creneau(date,horaire,reserver,week) values (?,?,0,?);');
            $cmd->bindParam(1,$date);
            $cmd->bindParam(2,$item);
            $cmd->bindParam(3,$week);
            $cmd->execute();
        }

        //delete les creneaux du jour qui se termine(spécification de setCreneaux lui-même)
        if($DeleteJourActuel){
            $cmd=$this->pdo->prepare('delete from creneau where week=1;');
            $cmd->execute();
            //actualiser les dates(week)
            $cmd=$this->pdo->prepare('update from creneau set week=week-1;');
        }
    }

    private function createCreneaux(array $hour): array
    {
        $Creneaux=[];//retourne un tableau contenant les crenaux
        //déterminons le temps d'ouverture en minute
        $tempMidi=($hour['midi']['hclose']*60+$hour['midi']['minclose'])-($hour['midi']['hopen']*60+$hour['midi']['minopen']);
        if($tempMidi<0){$tempMidi+=1440;}
        $tempSoir=($hour['soir']['hclose']*60+$hour['soir']['minclose'])-($hour['soir']['hopen']*60+$hour['soir']['minopen']);
        if($tempSoir<0){$tempSoir+=1440;}
        //déterminons les heures de resévations disponibles
        if($tempMidi!=0){
            $hmidiop=$hour['midi']['hopen'];if($hmidiop<10){$hmidiop='0'.$hmidiop;}
            $minmidiop=$hour['midi']['minopen'];if($minmidiop<10){$minmidiop='0'.$minmidiop;}
            $Creneaux[]=$hmidiop.':'.$minmidiop;
            $nbrHour=$tempMidi/$_ENV['intervalResevation'];
            for($i=1;$i<$nbrHour;$i++){
                $creneau=$hour['midi']['hopen']*60+$hour['midi']['minopen']+$_ENV['intervalResevation']*$i;
                $hcreneau=$creneau/60-($creneau%60)/60;if($hcreneau<10){$hcreneau='0'.$hcreneau;}
                $mincreneau=$creneau%60;if($mincreneau<10){$mincreneau='0'.$mincreneau;}
                $Creneaux[]=$hcreneau.':'.$mincreneau;
            }
        }
        if($tempSoir!=0){
            $hsoirop=$hour['soir']['hopen'];if($hsoirop<10){$hsoirop='0'.$hsoirop;}
            $minsoirop=$hour['soir']['minopen'];if($minsoirop<10){$minsoirop='0'.$minsoirop;}
            $Creneaux[]=$hsoirop.':'.$minsoirop;
            $nbrHour=$tempSoir/$_ENV['intervalResevation'];
            for($i=1;$i<$nbrHour;$i++){
                $creneau=$hour['soir']['hopen']*60+$hour['soir']['minopen']+$_ENV['intervalResevation']*$i;
                if($creneau>=1440){$creneau-=1440;}
                $hcreneau=$creneau/60-($creneau%60)/60;if($hcreneau<10){$hcreneau='0'.$hcreneau;}
                $mincreneau=$creneau%60;if($mincreneau<10){$mincreneau='0'.$mincreneau;}
                $Creneaux[]=$hcreneau.':'.$mincreneau;
            }
        }
        return $Creneaux;
    }

    public function getCreneaux(bool $chg_path=false)
    {
        //récupérer les creneaux
        $cmd=$this->pdo->prepare('select * from creneau;');
        $cmd->execute();
        //Stockage en fichier json
        $creneaux=json_encode($cmd->fetchAll(PDO::FETCH_ASSOC));
        $path='quaiAntique/data/creneaux.json';
        if($chg_path){$path='./public/quaiAntique/data/creneaux.json';}
        $dataCreneaux=fopen($path,'w');
        fwrite($dataCreneaux,$creneaux);
        fclose($dataCreneaux);
    }
}