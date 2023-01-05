<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

use Cron\CronExpression as CronExpressionLib;
use Psr\Log\LoggerInterface;

final class CronJobScheduler
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    public function isAllowed(string $jobName, CronExpression $jobCronExpression, \DateTimeInterface $dateTime): bool
    {
        if (!CronExpressionLib::isValidExpression($jobCronExpression->expression)) {
            $this->logger->error(\sprintf(
                '<error>Job "%s" [%s] is not a valid crontab expression - cannot run.</error>',
                $jobName,
                $jobCronExpression->expression
            ));

            return false;
        }

        $exprInterpreter = new CronExpressionLib($jobCronExpression->expression);

        if (!$exprInterpreter->isDue($dateTime)) {
            $this->logger->info(\sprintf('Job "%s" [%s] will be skipped.', $jobName, $jobCronExpression->expression));

            return false;
        }

        $this->logger->info(\sprintf('Job "%s" [%s] will run.', $jobName, $jobCronExpression->expression));

        return true;
    }
}
