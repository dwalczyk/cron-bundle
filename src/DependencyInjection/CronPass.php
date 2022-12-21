<?php

namespace Dawid\CronBundle\DependencyInjection;

use Dawid\CronBundle\CronJobInterface;
use Dawid\CronBundle\CronJobRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class CronPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $this->processJobs($container);
    }

    private function processJobs(ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(CronJobInterface::class)->addTag('cron.job');

        $definition = $container->findDefinition(CronJobRegistry::class);

        $taggedServices = $container->findTaggedServiceIds('cron.job');

        foreach ($taggedServices as $id => $tags) {
            $definition->setArgument('$jobs', [new Reference($id)]);
        }
    }
}