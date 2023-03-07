<?php

namespace App\Service;

use DateTimeImmutable;

class CreateToken{

    private array $header=[
        'head'=>'QA',
        'algo'=>'sha256'
    ];
    private array $user;
    private string $cle;
    private int $delai=604800;

    public function __construct(int $user_id=0,bool $createToken=true){
        $this->cle=$_ENV['APP_SECRET'];
        $this->user['user_id']=$user_id;
        if($createToken){
            $this->user['cap']=(new DateTimeImmutable)->getTimestamp();
            $this->user['del']=(new DateTimeImmutable)->getTimestamp()+$this->delai;
        }
    }

    public function generateToken(bool $verif=false,array $user=[]): string{

        if(!$verif){
            $user=$this->user;
        }

        //Encodage base 64
        $Header=base64_encode(json_encode($this->header));
        $User=base64_encode(json_encode($user));
        //Nettoyage des valeurs encodées
        $Header=str_replace(['+','/','='],['-','_',''],$Header);
        $User=str_replace(['+','/','='],['-','_',''],$User);

        //Création token
        $cle=base64_encode($this->cle);
        $cle= hash_hmac('sha256',$Header.'.'.$User,$cle,true);
        $Cle=base64_encode($cle);
        $Cle=str_replace(['+','/','='],['-','_',''],$Cle);
        $token=$Header.'.'.$User.'.'.$Cle;

        return $token;
    }

    public function isValid(string $token): bool{

        return ($this->inDelai($token)&&$this->isqaToken($token)&&$this->verifCheck($token));
    }

    public function getId($token): int{
        $seq=explode('.',$token);
        $User=json_decode(base64_decode($seq[1]),true);

        return $User['user_id'];
    }

    private function isqaToken(string $token): bool{

        return preg_match('/^[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+$/',$token)===1;
    }

    private function inDelai(string $token): bool{

        $seq=explode('.',$token);
        $User=json_decode(base64_decode($seq[1]),true);

        return $User['del']>(new DateTimeImmutable)->getTimestamp();
    }

    private function verifCheck(string $token){

        $seq=explode('.',$token);
        $User=json_decode(base64_decode($seq[1]),true);

        $verifToken= $this->generateToken(true,$User);

        return $token===$verifToken;
    }
}