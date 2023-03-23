<?php

namespace App\Repository\Qa;

use PDO;

class Produit{

    private string $title,$description,$type;
    private float $prix;
    private PDO $pdo;

    public function __construct(string $type='Plat',string $title='0',string $description='0',float $prix=0){
        $this->title=ucfirst(strtolower($title));
        $this->description=$description;
        $this->prix=$prix;
        $this->type=$type;
        $this->pdo= new PDO($_ENV['dsn'],$_ENV['user'],$_ENV['password']);
    }

    public function setProduit(){
        $cmd=$this->pdo->prepare("insert into produit(title,description,prix,type) value (?,?,?,?);");
        $cmd->bindParam(1,$this->title);
        $cmd->bindParam(2,$this->description);
        $cmd->bindParam(3,$this->prix);
        $cmd->bindParam(4,$this->type);
        $cmd->execute();
    }

    public function updateProduit($id)
    {
        $cmd=$this->pdo->prepare("update produit set title=?,description=?,prix=? where id=?;");
        $cmd->bindParam(1,$this->title);
        $cmd->bindParam(2,$this->description);
        $cmd->bindParam(3,$this->prix);
        $cmd->bindParam(4,$id);
        $cmd->execute();
    }

    public function delProduit(int $id){
        //delete
        $cmd=$this->pdo->prepare("delete from produit where id=?;");
        $cmd->bindParam(1,$id);
        $cmd->execute();
    }

    public function getProduits(): array{
        $produit=[
          "plat"=>[],
          "entree"=>[],
          "dessert"=>[],
          "boisson"=>[],
        ];
        $cmd=$this->pdo->prepare('select * from produit;');
        $cmd->execute();
        $response=$cmd->fetchAll(PDO::FETCH_ASSOC);
        foreach($response as $item){
            if($item['TYPE']=='Plat'){
                $produit['plat'][]=$item;
            }elseif($item['TYPE']=='Entrée'){
                $produit['entree'][]=$item;
            }elseif($item['TYPE']=='Dessert'){
                $produit['dessert'][]=$item;
            }else{
                $produit['boisson'][]=$item;
            }
        }

        return $produit;
    }
}