<?php

namespace Dawid\CronBundle;

enum CronJobResultStateEnum: string
{
    case SUCCESS = 'success';
    case FAILED = 'failed';
}
