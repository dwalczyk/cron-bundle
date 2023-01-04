<?php

namespace Dawid\CronBundle;

use Cron\CronExpression;
use Symfony\Component\Console\Output\OutputInterface;

final class CronJobScheduler
{
    public function __construct(private readonly PassedJobsInterfaceRepository $passedJobsInterfaceRepository)
    {
    }

    public function isAllowed(CronJobInterface $job, OutputInterface $output): bool
    {
        foreach ($job->getCronExpressions() as $cronExpression) {
            if (!CronExpression::isValidExpression($cronExpression)) {
                $output->writeln(sprintf('<error>[%s] "%s" is not a valid crontab expression - cannot run</error>',
                    $job->getName(), $cronExpression), OutputInterface::VERBOSITY_QUIET);

                return false;
            }

            $exprInterpreter = new CronExpression($cronExpression);

            dump($exprInterpreter->getPreviousRunDate());
            dump($exprInterpreter->getNextRunDate());

            if (!$exprInterpreter->isDue()) {
                $output->writeln(sprintf('%s will be skipped [%s]',
                    $job->getName(),
                    $cronExpression,
                ));

                return false;
            }

            $output->writeln(sprintf('%s will run [%s]',
                $job->getName(),
                $cronExpression
            ));
        }

        return true;
    }
}