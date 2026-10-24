<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Application;

#[AsCommand(
    name: 'alfeelsham:db:create',
    description: 'Supprime et recrée la base de données'
)]
class AlfeelshamDbCreateCommand extends Command
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $io = new SymfonyStyle($input, $output);
        $application = $this->getApplication();

        $dropCommand = $application->find('doctrine:database:drop');
        $dropCommand->run(
            new \Symfony\Component\Console\Input\ArrayInput([
                '--force' => true,
                '--if-exists' => true,
            ]),
            $output
        );

        $createCommand = $application->find('doctrine:database:create');
        $result = $createCommand->run(
            new \Symfony\Component\Console\Input\ArrayInput([]),
            $output
        );

        if ($result !== Command::SUCCESS) {
            $io->error('La création de la base de données a échoué.');
            return Command::FAILURE;
        }

        $io->success('La base de données a été recréée.');

        return Command::SUCCESS;
    }
}
