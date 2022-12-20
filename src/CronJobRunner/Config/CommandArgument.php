<?php

declare(strict_types=1);

namespace App\Core\Cron\CronJobRunner\Config;

final class CommandArgument
{
    public function __construct(
        public readonly string $name,
        public readonly mixed $value
    ) {
    }
}
