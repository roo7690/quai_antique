<?php

namespace App\Repository\Qa;

use PDO;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class Galerie{

    private string $title,$file;
    private PDO $pdo;

    public function __construct(string $title='0',string $file='0'){
        $this->title=strtoupper($title);
        $this->file=$file;
        $this->pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
    }

    public function setGalerie(){
        $cmd=$this->pdo->prepare("insert into galerie(title,file) value (?,?);");
        $cmd->bindParam(1,$this->title);
        $cmd->bindParam(2,$this->file);
        $cmd->execute();
    }

    public function delGalerie(string $id){
        //le retrouver
        $id=substr($id,strpos($id,'_')+1);
        //delete
        $cmd=$this->pdo->prepare("delete from galerie where id=?;");
        $cmd->bindParam(1,$id);
        $cmd->execute();
    }

    public function getGaleries(): array{
        $galerie=[];
        $cmd=$this->pdo->prepare('select * from galerie;');
        $cmd->execute();
        $response=$cmd->fetchAll(PDO::FETCH_ASSOC);
        foreach ($response as $item){
            $item['file']=(new PathPackage('img/galerie/',new EmptyVersionStrategy()))->getUrl($item['file']);
            $galerie[]=$item;
        }
        return $galerie;
    }
    public function getGalerie(): array{
        $cmd=$this->pdo->prepare('select * from galerie order by rand() limit 1;');
        $cmd->execute();
        $response=$cmd->fetch(PDO::FETCH_ASSOC);
        $response['file']=(new PathPackage('img/galerie/',new EmptyVersionStrategy()))->getUrl($response['file']);
        return $response;
    }

}