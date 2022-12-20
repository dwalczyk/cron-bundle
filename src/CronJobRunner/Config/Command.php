<?php

declare(strict_types=1);

namespace App\Core\Cron\CronJobRunner\Config;

final class Command
{
    /**
     * @param CommandArgument[] $arguments
     * @param CommandOption[] $options
     * @param CommandOption[] $multiValueOptions
     */
    public function __construct(
        public readonly string $name,
        public readonly string $cronExpr,
        public readonly array $arguments,
        public readonly array $options,
        public readonly array $multiValueOptions,
        public readonly bool $enabled
    ) {
    }
}
