<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use \DateTime;

class BurgerQuiz extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'burgerQuiz';

    protected function configure()
    {
		$this->addArgument('nombre', InputArgument::REQUIRED, 'un nombre au hasard.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nombre = $input->getArgument('nombre');		
		$division = $nombre/2;
		$precedent = $nombre-1;
		$suivant = $nombre+1;
		
		$output->writeln("le nombre divisé est ".$division." le nombre précédent est ".$precedent." le nombre suivant est ".$suivant);
        
    }
}