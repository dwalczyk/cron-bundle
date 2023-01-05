<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

interface CronJobRegistryInterface
{
    /**
     * @return CronJobInterface[]
     */
    public function all(): iterable;
}
