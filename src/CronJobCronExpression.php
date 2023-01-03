<?php

namespace Dawid\CronBundle;

final class CronJobCronExpression
{
    public function __construct(
        public readonly string $expression
    )
    {
    }
}