<?php

declare(strict_types=1);

namespace Dawid\CronBundle\DependencyInjection;

use Dawid\CronBundle\CronJobRunner\Config\Config;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class CronExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->loadServices($container);
        $this->_processConfiguration($configs, $container);
    }

    private function _processConfiguration(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $configDef = $container->getDefinition(Config::class);
        $configDef->replaceArgument('$commands', $config['jobs']);
    }

    private function loadServices(ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');
    }
}
