<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

use Symfony\Component\Console\Output\OutputInterface;

final class Cron
{
    public function __construct(
        private readonly CronJobScheduler              $jobScheduler,
        private readonly CronJobRegistryInterface      $registry,
    )
    {}

    public function run(OutputInterface $output): void
    {
        foreach ($this->registry->all() as $job) {
            if ($this->jobScheduler->isAllowed($job, $output)) {

            }
        }
    }
}
