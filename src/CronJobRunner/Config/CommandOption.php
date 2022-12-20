<?php

declare(strict_types=1);

namespace Dawid\CronBundle\CronJobRunner\Config;

final class CommandOption
{
    public function __construct(
        public readonly string $name,
        public readonly mixed $value
    ) {
    }

    public function getNameWithMinusPrefix(): string
    {
        return \sprintf('--%s', $this->name);
    }
}
