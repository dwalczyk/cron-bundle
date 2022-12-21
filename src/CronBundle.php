<?php

declare(strict_types=1);

namespace Dawid\CronBundle;

use Dawid\CronBundle\DependencyInjection\CronPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class CronBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CronPass());
    }
}
