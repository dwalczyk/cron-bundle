<?php

declare(strict_types=1);

namespace Dawid\CronBundle\CronJobRunner;

use Dawid\CronBundle\CronJobRunner\Config\Config;
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

            if ($this->jobScheduler->isAllowed($command, $output)) {
                $this->commandRunner->run($command, $output);
            }
        }
    }
}
