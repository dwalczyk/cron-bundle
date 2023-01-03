<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

use Symfony\Component\Console\Output\OutputInterface;

final class Cron
{
    public function __construct(
        private readonly PassedJobsInterfaceRepository $passedJobsInterfaceRepository
    )
    {}

    public function run(OutputInterface $output): ?int
    {
        return $this->passedJobsInterfaceRepository->getDateTimeOfLastPassedJobByName('xxx')?->getTimestamp();
    }
}
