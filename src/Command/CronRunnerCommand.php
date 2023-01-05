<?php

declare(strict_types=1);

namespace Dawid\CronBundle\Command;

use Dawid\CronBundle\Cron;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class CronRunnerCommand extends Command
{
    use LockableTrait;

    public function __construct(private readonly Cron $runner, private readonly ?LoggerInterface $logger)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Processes command schedule and runs commands according to configuration')
            ->addOption('lock', null, InputOption::VALUE_NONE, 'Prevents from running multiple instances')
            ->addOption('execution_datetime', null, InputOption::VALUE_OPTIONAL, 'Set jobs execution datetime')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($lockOthers = $input->getOption('lock')) {
            if (!$this->lock()) {
                $this->logger?->info('Cron job already running, skipping current process');

                $output->writeln('Cron job already running, skipping current process');

                return 0;
            }
        }

        $dateTime = new \DateTime();

        $executionDateTime = $input->getOption('execution_datetime');
        if (!empty($executionDateTime)) {
            $dateTime->setTimestamp(\strtotime($executionDateTime));
        }

        $this->runner->run($dateTime, $output);

        if ($lockOthers) {
            $this->release();
        }

        return 0;
    }
}
