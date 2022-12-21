<?php

namespace Dawid\CronBundle;

final class CrobJobCronExpression
{
    public function __construct(
        public readonly string $expression
    )
    {
    }
}