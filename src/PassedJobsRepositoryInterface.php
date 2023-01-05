<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

interface PassedJobsRepositoryInterface
{
    /**
     * @return PassedJob[]
     */
    public function findAll(): iterable;

    public function save(PassedJob $job): void;
}
