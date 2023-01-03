<?php

namespace Dawid\CronBundle;

interface PassedJobsInterfaceRepository
{
    public function getDateTimeOfLastPassedJobByName(string $name): ?\DateTimeInterface;
}