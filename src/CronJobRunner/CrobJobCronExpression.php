<?php

namespace Dawid\CronBundle\CronJobRunner;

final class CrobJobCronExpression
{
    public function __construct(
        public readonly string $expression
    )
    {
    }
}