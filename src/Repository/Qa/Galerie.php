<?php

namespace App\Repository\Qa;

use PDO;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class Galerie{

    private string $title;
    private array $file;
    private PDO $pdo;

    public function __construct(string $title='0',array $file=[]){
        $this->title=ucfirst(strtolower($title));
        $this->file=$file;
        $this->pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
    }

    public function setGalerie()
    {
        $file=uniqid().'.'.pathinfo($this->file['name'])['extension'];
        move_uploaded_file($this->file['tmp_name'],'img/galerie/'.$file);

        $cmd=$this->pdo->prepare("insert into galerie(title,file) value (?,?);");
        $cmd->bindParam(1,$this->title);
        $cmd->bindParam(2,$file);
        $cmd->execute();
    }

    public function updateGalerie(int $id)
    {
        $cmd=$this->pdo->prepare("update galerie set title=? where id=?;");
        $cmd->bindParam(1,$this->title);
        $cmd->bindParam(2,$id);
        $cmd->execute();
    }

    public function delGalerie(int $id){
        //retrouver le filename
        $cmd=$this->pdo->prepare("select file from galerie where id=?");
        $cmd->bindParam(1,$id);
        $cmd->execute();
        $file=$cmd->fetch(PDO::FETCH_ASSOC);
        //supprimer l'image dans le server
        unlink('img/galerie/'.$file['file']);
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