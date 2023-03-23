<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use App\Repository\User\Admin;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:admin','Gestion des administrateurs')]
class AdminCommand extends Command
{
    private Admin $Admin;

    public function __construct(Admin $admin)
    {
        parent::__construct();
        $this->Admin=$admin;
    }

    protected function configure()
    {
        $this
            ->addArgument('password',InputArgument::REQUIRED,'mot de passe')
            ->addOption('add',null,InputOption::VALUE_NONE,'Ajoute un administrateur')
        ;
    }

    protected function execute(InputInterface $input,OutputInterface $output): int
    {
        $write= new SymfonyStyle($input,$output);

        if($input->getArgument('password')==$_ENV['admin']){

            if($input->getOption('add')){
                $email=$write->ask('Veuillez entrer l\'email');
                $is_user=$this->Admin->isUser($email);
                if(!$is_user){
                    $write->error('Cet email ne possède pas de compte quai antique!');
                    return Command::FAILURE;
                }else{
                    $galerie=$write->choice('Cet administrateur s\'occupera-t\'il de la galerie ?',['Oui','Non']);
                    $produit=$write->choice('Cet administrateur s\'occupera-t\'il des produits ?',['Oui','Non']);
                    $horaire=$write->choice('Cet administrateur s\'occupera-t\'il des horaires ?',['Oui','Non']);

                    if($galerie=='Oui'){$galerie=true;}else{$galerie=false;}
                    if($produit=='Oui'){$produit=true;}else{$produit=false;}
                    if($horaire=='Oui'){$horaire=true;}else{$horaire=false;}

                    $this->Admin->setAdmin($email,$produit,$horaire,$galerie);

                    $write->success('Administrateur crée avec succès');
                    return Command::SUCCESS;
                }
            }



            $write->error('Aucune option sélectionner!');
            return Command::FAILURE;
        }
        
        $write->error('Vous n\'avez pas d\'autoristion !');
        return Command::FAILURE;
    }
}