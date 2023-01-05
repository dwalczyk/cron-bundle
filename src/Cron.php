<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Cron
{
    public function __construct(
        private readonly CronJobScheduler $scheduler,
        private readonly CronJobRegistryInterface $registry,
        private readonly PassedJobsRepositoryInterface $passedJobsRepository,
        private readonly LoggerInterface $logger
    ) {
    }

    public function run(\DateTimeInterface $dateTime, OutputInterface $output): void
    {
        foreach ($this->registry->all() as $job) {
            $this->handleJob($job, $dateTime, $output);
        }
    }

    private function handleJob(CronJobInterface $job, \DateTimeInterface $dateTime, OutputInterface $output): void
    {
        foreach ($job->getCronExpressions() as $cronExpression) {
            try {
                if (!$this->scheduler->isAllowed($job->getName(), $cronExpression, $dateTime)) {
                    $msg = \sprintf('Job "%s" [%s] not allowed by scheduler - skipped.', $job->getName(), $cronExpression->expression);
                    $output->writeln(\sprintf('<comment>%s</comment>', $msg));

                    continue;
                }

                $job->run();

                $state = CronJobResultStateEnum::SUCCESS;
                $msg = \sprintf('Job "%s" [%s] executed successfully.', $job->getName(), $cronExpression->expression);

                $this->logger->info($msg);
                $output->writeln(\sprintf('<info>%s</info>', $msg));
            } catch (\Throwable $e) {
                $state = CronJobResultStateEnum::FAILED;
                $msg = \sprintf(
                    'Job "%s" [%s] failed. Exception: %s.',
                    $job->getName(),
                    $cronExpression->expression,
                    $e->getMessage()
                );

                $this->logger->error($msg);
                $output->writeln(\sprintf('<error>%s</error>', $msg));
            }

            $passedJob = new PassedJob(
                $job->getName(),
                $state,
                $cronExpression->expression,
                \DateTimeImmutable::createFromInterface($dateTime)
            );
            $this->passedJobsRepository->save($passedJob);
        }
    }
}
