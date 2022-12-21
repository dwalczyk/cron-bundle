<?php

namespace Dawid\CronBundle;

use Cron\CronExpression;
use Symfony\Component\Console\Output\OutputInterface;

final class JobScheduler
{
    public function isAllowed(CronJobInterface $cronJob, OutputInterface $output): bool
    {
        return true;

        if (!CronExpression::isValidExpression($command->cronExpr)) {
            $output->writeln(sprintf('<error>[%s] "%s" is not a valid crontab expression - cannot run</error>',
                $command->name, $command->cronExpr), OutputInterface::VERBOSITY_QUIET);

            return false;
        }

        $exprInterpreter = new CronExpression($command->cronExpr);

        if (!$command->enabled || !$exprInterpreter->isDue()) {
            $output->writeln(sprintf('%s will be skipped [%s] [enabled: %s]',
                $command->name,
                $command->cronExpr,
                $command->enabled ? 'true' : 'false'
            ));

            return false;
        }

        if (!$command->enabled || !$exprInterpreter->isDue()) {
            $output->writeln(sprintf('%s will be skipped [%s] [enabled: %s]',
                $command->name,
                $command->cronExpr,
                $command->enabled ? 'true' : 'false'
            ));

            return false;
        }

        $output->writeln(sprintf('%s will run [%s]',
            $command->name,
            $command->cronExpr
        ));

        return true;
    }
}