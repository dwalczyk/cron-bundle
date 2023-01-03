<?php

namespace Dawid\CronBundle;

enum PassedJobResultEnum: string
{
    case SUCCESS = 'success';
    case FAILED = 'failed';
}
