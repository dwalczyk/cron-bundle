<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

interface CronJobInterface
{
    public function run(): void;

    public function getCronExpressions(): CronExpressionCollection;

    public function getName(): string;
}
