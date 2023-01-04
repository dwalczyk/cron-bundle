<?php

namespace Dawid\CronBundle;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class PassedJob
{
    private UuidInterface $id;

    private string $name;

    private PassedJobResultEnum $result;

    private string $cronExpression;

    private \DateTimeImmutable $cronDate;

    private \DateTimeImmutable $passedAt;

    public function __construct(
        string $name,
        PassedJobResultEnum $result,
        string $cronExpression,
        \DateTimeImmutable $cronDate
    )
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->result = $result;
        $this->cronExpression = $cronExpression;
        $this->cronDate = $cronDate;
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

    public function getResult(): PassedJobResultEnum
    {
        return $this->result;
    }

    public function getCronExpression(): string
    {
        return $this->cronExpression;
    }

    public function getCronDate(): \DateTimeImmutable
    {
        return $this->cronDate;
    }

    public function getPassedAt(): \DateTimeImmutable
    {
        return $this->passedAt;
    }
}