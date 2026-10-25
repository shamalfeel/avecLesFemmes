<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Question\ConfirmationQuestion;


#[AsCommand(
    name: 'alfeelsham:migration',
    description: 'Génère et exécute les migrations Doctrine'
)]
class AlfeelshamMigrationCommand extends Command
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $application = $this->getApplication();

        if ($application === null) {
            return Command::FAILURE;
        }

        // Générer la migration
        $output->writeln('<info>Génération de la migration...</info>');

        $makeMigration = $application->find('make:migration');
        $result = $makeMigration->run(
            new ArrayInput([]),
            $output
        );

        if ($result !== Command::SUCCESS) {
            return $result;
        }

        // Exécuter les migrations
        $output->writeln('<info>Exécution des migrations...</info>');

        $migrate = $application->find('doctrine:migrations:migrate');

        $migrateInput = new ArrayInput([
            '--no-interaction' => true,
        ]);

        return $migrate->run($migrateInput, $output);
    }
}