<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

final class CronJobRegistry implements CronJobRegistryInterface
{
    private readonly array $jobs;

    public function __construct(iterable $jobs)
    {
        $arrayJobs = [];

        foreach ($jobs as $job) {
            $arrayJobs[] = $job;
        }

        $this->jobs = $arrayJobs;
    }

    public function all(): iterable
    {
        return $this->jobs;
    }
}
