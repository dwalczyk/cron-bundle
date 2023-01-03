<?php

namespace Dawid\CronBundle;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class PassedJob
{
    private UuidInterface $id;

    private string $name;

    private PassedJobResultEnum $result;

    private \DateTimeImmutable $passedAt;

    public function __construct(
        string $name,
        PassedJobResultEnum $result
    )
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->result = $result;
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

    public function getPassedAt(): \DateTimeImmutable
    {
        return $this->passedAt;
    }
}