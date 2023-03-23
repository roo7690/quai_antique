<?php

namespace App\Command;

use App\Repository\HoraireController\HoraireController;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:creneaux','Reintialisation et mise a jour de creneau')]
class UpdateCreneauxCommand extends Command{

    private HoraireController $horaireController;

    public function __construct(HoraireController $horaireController){
        parent::__construct();
        $this->horaireController=$horaireController;
    }

    protected function configure(){
        $this
            ->addOption('chg',null,InputOption::VALUE_NONE,'Change les creneaux suite aux changements des horaires')
            ->addOption('set',null,InputOption::VALUE_NONE,'Met a jour les creneaux tous les 24h')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output):int 
    {
        $write=new SymfonyStyle($input,$output);

        if($input->getOption('chg')){
            $this->horaireController->changeCreneaux();
            $this->horaireController->getCreneaux(true);
            $output->writeln('Reintialisation des creneaux');
            $write->success('Success!');

            return Command::SUCCESS;
        }elseif($input->getOption('set')){
            $this->horaireController->setCreneaux(1,true);
            $output->writeln('Mise a jour de creneaux');
            $write->success('Success!');

            return Command::SUCCESS;
        }

        $write->error('Nécessite l\'Ajout d\'une option!');
        return Command::FAILURE;
    }
}