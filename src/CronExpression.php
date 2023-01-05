<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

final class CronExpression
{
    public function __construct(
        public readonly string $expression
    ) {
    }
}
