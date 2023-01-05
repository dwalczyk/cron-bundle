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

        $id = \time();

        $this->logger?->info(\sprintf('Running cron job [%d]', $id));

        $this->runner->run($output);

        $this->logger?->info(\sprintf('Cron job finished [%d]', $id));

        if ($lockOthers) {
            $this->release();
        }

        return 0;
    }
}
