<?php

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class Test1 extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'test1';

    protected function configure()
    {
		
	}

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$helper = $this->getHelper('question');
		$question = new Question('Veuillez saisir un nombre : ',6);
		$nombre = $helper->ask($input, $output, $question);
		$double = $nombre*2;
		$moitie = $nombre/2;
		$output->writeln("le double de ".$nombre." est ".$double." la moitié de ".$nombre." est ".$moitie);
        
    }
}



