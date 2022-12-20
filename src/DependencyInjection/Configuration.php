<?php

declare(strict_types=1);

namespace App\Core\Cron\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('cron');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
            ->arrayNode('jobs')
                ->prototype('array')
                ->children()
                    ->scalarNode('name')->cannotBeEmpty()->end()
                    ->booleanNode('enabled')->defaultTrue()->end()
                    ->scalarNode('cron_expression')->cannotBeEmpty()->end()
                    ->arrayNode('arguments')
                        ->prototype('scalar')->end()
                    ->end()
                    ->arrayNode('options')
                        ->prototype('scalar')->end()
                    ->end()
                    ->arrayNode('multi_value_options')
                        ->prototype('array')
                        ->prototype('scalar')->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
