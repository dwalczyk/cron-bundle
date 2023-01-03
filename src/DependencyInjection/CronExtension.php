<?php

namespace Dawid\CronBundle\DependencyInjection;

use Dawid\CronBundle\CronJobInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class CronExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->loadServices($container);
    }

    private function loadServices(ContainerBuilder $container): void
    {
        $container->registerForAutoconfiguration(CronJobInterface::class)->addTag('cron.job');

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../config')
        );
        $loader->load('services.yaml');
    }
}