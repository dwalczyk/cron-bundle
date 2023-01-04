<?php

namespace Dawid\CronBundle;

use Symfony\Component\Console\Output\OutputInterface;

interface CronJobInterface
{
    public function run(OutputInterface $output): CronJobResult;

    /**
     * @return CronJobCronExpression[]
     */
    public function getCronExpressions(): iterable;

    public function getName(): string;
}