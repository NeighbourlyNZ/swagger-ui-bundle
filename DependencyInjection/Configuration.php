<?php

namespace Ideahq\Bundle\SwaggerUIBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ideahq_swagger_ui');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode->addDefaultsIfNotSet()
                 ->children()
                    ->scalarNode('url')->end()
                    ->scalarNode('validator_url')->defaultValue('https://online.swagger.io/validator')->end()
                    ->scalarNode('operations_sorter')->defaultValue('alpha')->end()
                    ->arrayNode('static_resources')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('resource_dir')->defaultValue(null)->end()
                            ->scalarNode('resource_list_filename')->defaultValue('api-docs.json')->end()
                        ->end()
                    ->end()
                 ->end();

        return $treeBuilder;
    }
}
