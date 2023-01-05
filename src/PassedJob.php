<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class PassedJob
{
    private UuidInterface $id;

    private string $name;

    private CronJobResultStateEnum $state;

    private string $cronExpression;

    private \DateTimeImmutable $passedAt;

    public function __construct(
        string $name,
        CronJobResultStateEnum $state,
        string $cronExpression
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->state = $state;
        $this->cronExpression = $cronExpression;
        $this->passedAt = new \DateTimeImmutable();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getState(): CronJobResultStateEnum
    {
        return $this->state;
    }

    public function getCronExpression(): string
    {
        return $this->cronExpression;
    }

    public function getPassedAt(): \DateTimeImmutable
    {
        return $this->passedAt;
    }
}
