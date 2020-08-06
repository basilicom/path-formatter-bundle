<?php

declare(strict_types=1);

namespace Basilicom\PathFormatterBundle\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Yaml\Yaml;

class BasilicomPathFormatterExtensionTest extends TestCase
{
    /**
     * @test
     */
    public function load(): void
    {
        // prepare
        $configs = Yaml::parse(
            file_get_contents(dirname(dirname(dirname(__DIR__))) . '/src/Resources/config/pimcore/config.yml')
        );

        $containerDefinitionMock = $this->createMock(Definition::class);
        $containerDefinitionMock->expects($this->at(0))
            ->method('setArgument')
            ->with(1, true);
        $containerDefinitionMock->expects($this->at(1))
            ->method('setArgument')
            ->with(
                2,
                [
                    'Pimcore\Model\DataObject\Concrete' => '',
                ]
            );

        $containerMock = $this->createMock(ContainerBuilder::class);
        $containerMock->method('getDefinition')->willReturn($containerDefinitionMock);

        $classUnderTest = new BasilicomPathFormatterExtension();

        // test
        $classUnderTest->load($configs, $containerMock);
        // verified by setup
    }
}
