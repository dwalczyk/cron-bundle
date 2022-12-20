<?php

namespace Dawid\CronBundle\CronJobRunner;

interface CronJobRegistryInterface
{
    /**
     * @return CronJobInterface[]
     */
    public function all(): iterable;
}