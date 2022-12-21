<?php

namespace Dawid\CronBundle;

interface CronJobRegistryInterface
{
    /**
     * @return CronJobInterface[]
     */
    public function all(): iterable;
}