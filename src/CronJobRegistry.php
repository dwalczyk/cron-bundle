<?php

namespace Dawid\CronBundle;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final class CronJobRegistry implements CronJobRegistryInterface
{
    private readonly array $jobs;

    public function __construct(
        #[TaggedIterator('cron.job')] iterable $jobs
    )
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