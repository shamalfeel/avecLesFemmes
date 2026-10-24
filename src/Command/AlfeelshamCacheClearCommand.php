<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'alfeelsham:cache:clear',
    description: 'Vide le cache de Symfony'
)]
class AlfeelshamCacheClearCommand extends Command
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $process = new Process([
            PHP_BINARY,
            'bin/console',
            'cache:clear'
        ]);

        $process->run();

        $output->write($process->getOutput());
        $output->write($process->getErrorOutput());

        return $process->isSuccessful()
            ? Command::SUCCESS
            : Command::FAILURE;
    }
}
