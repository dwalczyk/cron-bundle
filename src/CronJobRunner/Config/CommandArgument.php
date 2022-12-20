<?php

declare(strict_types=1);

namespace Dawid\CronBundle\CronJobRunner\Config;

final class CommandArgument
{
    public function __construct(
        public readonly string $name,
        public readonly mixed $value
    ) {
    }
}
