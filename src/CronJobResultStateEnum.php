<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

enum CronJobResultStateEnum: string
{
    case SUCCESS = 'success';
    case FAILED = 'failed';
}
