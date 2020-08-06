<?php

namespace Basilicom\PathFormatterBundle\DependencyInjection;

use Basilicom\PathFormatterBundle\DependencyInjection\PathFormatter\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class BasilicomPathFormatterExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new ConfigDefinition();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $definition = $container->getDefinition(BasilicomPathFormatter::class);

        $definition->setArgument(1, (bool) $config[ConfigDefinition::ENABLE_ASSET_PREVIEW]);
        $definition->setArgument(2, (array) $config[ConfigDefinition::PATTERN_LIST]);
    }
}
