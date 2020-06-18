<?php

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Psr\Log\LoggerInterface;

class Test3 extends Command
{
    protected static $defaultName = 'test3';
	
	private $logger;
	
	public function __construct(LoggerInterface $logger)
    {
		$this->logger = $logger;
		parent::__construct();
	}

    protected function configure()
    {
		
	}

    protected function execute(InputInterface $input, OutputInterface $output)
    {	
		$this->logger->info('début');
		$helper = $this->getHelper('question');
		$question = new Question("Quel est mon nombre d'élèves ?", 3);
		$nombreDeleves = $helper->ask($input, $output, $question);
	
		for($i=0; $i<$nombreDeleves; $i++){
			$e=$i+1;
			$question2 = new Question("Quelle est la note de l'élève numéro ".$e.'?');
			$note[$i]=$helper->ask($input, $output, $question2);
			
		
			if ($note[$i]>20) {
				$output->writeln("Votre note doit être comprise entre 0 et 20 !");
				$note[$i]=$helper->ask($input, $output, $question2);
			} 
		}
	$somme = array_sum($note);
	$moyenne = $somme/$nombreDeleves;
	$bigNote = max($note);
	$cancre = min($note);	
	$output->writeln("La moyenne de la classe est : ".$moyenne);
	$output->writeln("La note la plus haute est : ".$bigNote);
	$output->writeln("La note de la plus basse est : ".$cancre);
	}
}
	






