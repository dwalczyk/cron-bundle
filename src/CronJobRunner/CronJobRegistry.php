<?php

namespace Dawid\CronBundle\CronJobRunner;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

final class CronJobRegistry implements CronJobRegistryInterface
{
    public function __construct(
        #[TaggedIterator('cron.job')] iterable $jobs
    )
    {
    }

    public function all(): iterable
    {
        // TODO: Implement all() method.
    }
}