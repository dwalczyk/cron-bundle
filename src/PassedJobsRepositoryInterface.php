<?php

namespace Dawid\CronBundle;

interface PassedJobsRepositoryInterface
{
    public function getDateTimeOfLastPassedJobByName(string $name): ?\DateTimeInterface;
}