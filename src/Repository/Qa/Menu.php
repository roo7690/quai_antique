<?php

namespace App\Repository\Qa;

use PDO;

class Menu {

    private string $title,$description;
    private float $prix;
    private PDO $pdo;

    public function __construct(string $title='0',string $description='0',float $prix=0){
        $this->title=ucfirst(strtolower($title));
        $this->description=$description;
        $this->prix=$prix;
        $this->pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
    }

    public function setMenu(){
        $cmd=$this->pdo->prepare("insert into menu(title,description,prix) value (?,?,?);");
        $cmd->bindParam(1,$this->title);
        $cmd->bindParam(2,$this->description);
        $cmd->bindParam(3,$this->prix);
        $cmd->execute();
    }

    public function updateMenu($id)
    {
        $cmd=$this->pdo->prepare("update menu set title=?,description=?,prix=? where id=?;");
        $cmd->bindParam(1,$this->title);
        $cmd->bindParam(2,$this->description);
        $cmd->bindParam(3,$this->prix);
        $cmd->bindParam(4,$id);
        $cmd->execute();
    }

    public function delMenu(int $id){
        //delete
        $cmd=$this->pdo->prepare("delete from menu where id=?;");
        $cmd->bindParam(1,$id);
        $cmd->execute();
    }

    public function getMenus(): array{
        $cmd=$this->pdo->prepare('select * from menu;');
        $cmd->execute();

        return $cmd->fetchAll(PDO::FETCH_ASSOC);
    }
}