<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

interface CronJobInterface
{
    public function run(): void;

    /**
     * @return CronExpression[]
     */
    public function getCronExpressions(): iterable;

    public function getName(): string;
}
