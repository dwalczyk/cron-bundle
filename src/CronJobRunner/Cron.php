<?php

declare(strict_types=1);

namespace Dawid\CronBundle\CronJobRunner;

use Symfony\Component\Console\Output\OutputInterface;

final class Cron
{
    public function __construct(
        private readonly JobScheduler $jobScheduler,
        private readonly CronJobRegistryInterface $registry,
    )
    {}

    public function run(OutputInterface $output): void
    {
        foreach ($this->registry->all() as $job) {

        }
    }
}
