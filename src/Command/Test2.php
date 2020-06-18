<?php

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class Test2 extends Command
{
    const EXACT = '100';
	// the name of the command (the part after "bin/console")
    protected static $defaultName = 'test2';

    protected function configure()
    {
		
	}

    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$helper = $this->getHelper('question');
		$nombre = -1;
		while ($nombre != self::EXACT)
		{
			$question = new Question('Quel est mon nombre : ', 100);
			$nombre = $helper->ask($input, $output, $question);
		
			if ($nombre > self::EXACT) {
				$output->writeln("Votre nombre est trod élévé !");
			} 
			else if ($nombre < self::EXACT) {
				$output->writeln("Votre nombre est trop petit !");
			}
			else {
				$output->writeln("Félicitation !");				
			}
		}
	}
}
		
		
		





