<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

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

        // Générer la migration
        $makeMigration = $application->find('make:migration');
        $result = $makeMigration->run(new ArrayInput([]), $output);

        if ($result !== Command::SUCCESS) {
            return $result;
        }

        // Exécuter la migration
        $migrate = $application->find('doctrine:migrations:migrate');
        return $migrate->run(
            new ArrayInput(['--no-interaction' => true]),
            $output
        );
    }
}
