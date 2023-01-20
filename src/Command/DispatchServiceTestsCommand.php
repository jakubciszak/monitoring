<?php

namespace App\Command;

use App\Core\Service\ProcessServiceCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(
    name: 'app:services:dispatch',
    description: 'Dispatch services tests',

)]
class DispatchServiceTestsCommand extends Command
{
    public function __construct(private readonly ProcessServiceCommand $dispatchServiceTestsCommand)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->dispatchServiceTestsCommand->execute();
        } catch (Throwable $e) {
            $output->writeln($e->getMessage());
            $output->writeln($e->getFile());
            $output->writeln($e->getLine());
            $output->writeln($e->getTraceAsString());
            return Command::FAILURE;
        }
        return Command::SUCCESS;
    }

}
