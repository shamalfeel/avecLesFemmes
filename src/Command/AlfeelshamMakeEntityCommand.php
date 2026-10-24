<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(
    name: 'alfeelsham:make:entity',
    description: 'Crée une nouvelle entité Doctrine'
)]
class AlfeelshamMakeEntityCommand extends Command
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $command = $this->getApplication()->find('make:entity');

        return $command->run(
            new ArrayInput([]),
            $output
        );
    }
}
