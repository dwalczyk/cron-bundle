<?php

declare(strict_types=1);

namespace App\Core\Cron\CronJobRunner;

use App\Core\Cron\CronJobRunner\Config\Config;
use Symfony\Component\Console\Output\OutputInterface;

final class Cron
{
    public function __construct(
        private readonly Config $config,
        private readonly CommandRunner $commandRunner,
        private readonly JobScheduler $jobScheduler
    )
    {}

    public function run(OutputInterface $output): void
    {
        foreach ($this->config->getPreparedCommands() as $command) {
            $this->commandRunner->run($command, $output);
        }
    }
}
