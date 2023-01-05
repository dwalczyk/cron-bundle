<?php

declare(strict_types=1);

namespace Dawid\CronBundle\DependencyInjection;

use Dawid\CronBundle\CronJobRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class CronPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $this->processJobs($container);
    }

    private function processJobs(ContainerBuilder $container): void
    {
        $definition = $container->findDefinition(CronJobRegistry::class);

        $taggedServices = $container->findTaggedServiceIds('cron.job');

        foreach ($taggedServices as $id => $tags) {
            $definition->setArgument('$jobs', [new Reference($id)]);
        }
    }
}
