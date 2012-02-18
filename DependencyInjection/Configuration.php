<?php

namespace Webmil\TextLanguageDetectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for WebmilTextLanguageDetectBundle
 */
class Configuration implements ConfigurationInterface
{

    /**
     * Get config tree
     * 
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $root = $treeBuilder->root('webmil_text_language_detect');

        $root
            ->children()
                ->arrayNode('omit_languages')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('omit_list')
                            ->prototype('scalar')->end()
                            ->defaultValue(array())
                        ->end()
                        ->booleanNode('include_only')->defaultValue(false)->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

}