<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

use Psr\Log\LoggerInterface;

final class Cron
{
    public function __construct(
        private readonly CronJobScheduler $scheduler,
        private readonly CronJobRegistryInterface $registry,
        private readonly PassedJobsRepositoryInterface $passedJobsRepository,
        private readonly LoggerInterface $logger
    ) {
    }

    public function run(): void
    {
        foreach ($this->registry->all() as $job) {
            $this->handleJob($job);
        }
    }

    private function handleJob(CronJobInterface $job): void
    {
        foreach ($job->getCronExpressions() as $cronExpression) {
            try {
                if ($this->scheduler->isAllowed($job->getName(), $cronExpression)) {
                    $job->run();
                }

                $state = CronJobResultStateEnum::SUCCESS;

                $this->logger->info(
                    \sprintf('Job "%s" [%s] executed successfully.', $job->getName(), $cronExpression->expression)
                );
            } catch (\Throwable $e) {
                $state = CronJobResultStateEnum::FAILED;

                $this->logger->error(
                    \sprintf('Job "%s" [%s] failed. Exception: %s', $job->getName(), $cronExpression->expression, $e->getMessage())
                );
            }

            $passedJob = new PassedJob($job->getName(), $state, $cronExpression->expression);
            $this->passedJobsRepository->save($passedJob);
        }
    }
}
