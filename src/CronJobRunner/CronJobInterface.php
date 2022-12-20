<?php

namespace Dawid\CronBundle\CronJobRunner;

use Symfony\Component\Console\Output\OutputInterface;

interface CronJobInterface
{
    public function run(OutputInterface $output): void;

    /**
     * @return CrobJobCronExpression[]
     */
    public function getCronExpressions(): iterable;
}