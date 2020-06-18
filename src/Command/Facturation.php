<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use \DateTime;

class Facturation extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'facturation';
 
    protected function configure()
    {
		$this
			->addArgument('Month', InputArgument::REQUIRED, 'mois de facturation.')
			->addArgument('Year', InputArgument::REQUIRED, 'année de facturation');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $month = $input->getArgument('Month');
		$year = $input->getArgument('Year');
		$date = DateTime::createFromFormat('mY', $month.$year);
        $output->writeln("Facturation du mois " . $date->format('M')." de l'année ".$date->format('y'));
        
    }
}