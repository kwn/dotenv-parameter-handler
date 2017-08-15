<?php

namespace DotEnvParameterHandler;

use DotEnvParameterHandler\DotEnvGenerator\CopyPasteDotEnvGenerator;
use DotEnvParameterHandler\Exception\InvalidConfigurationException;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function testItReturnsDotEnvSource()
    {
        $configuration = new Configuration([
            'dot-env-parameter-handler' => [
                'source' => '.env.example'
            ]
        ]);

        self::assertEquals(getcwd() . DIRECTORY_SEPARATOR . '.env.example', $configuration->getSource());
    }

    public function testItHasDefaultValueForDotEnvSource()
    {
        $configuration = new Configuration();

        self::assertEquals(getcwd() . DIRECTORY_SEPARATOR . '.env.dist', $configuration->getSource());
    }

    public function testItReturnsDotEnvTarget()
    {
        $configuration = new Configuration([
            'dot-env-parameter-handler' => [
                'target' => '.envdest'
            ]
        ]);

        self::assertEquals(getcwd() . DIRECTORY_SEPARATOR . '.envdest', $configuration->getTarget());
    }

    public function testItHasDefaultValueForDotEnvTarget()
    {
        $configuration = new Configuration();

        self::assertEquals(getcwd() . DIRECTORY_SEPARATOR . '.env', $configuration->getTarget());
    }

    /**
     * @dataProvider strategyMappings
     */
    public function testItReturnsStrategyClass($strategy, $class)
    {
        $configuration = new Configuration([
            'dot-env-parameter-handler' => [
                'strategy' => $strategy
            ]
        ]);

        self::assertEquals($class, $configuration->getStrategyClass());
    }

    public function strategyMappings()
    {
        return [
            ['copypaste', CopyPasteDotEnvGenerator::class]
        ];
    }

    public function testItHasDefaultValueForDotEnvStrategy()
    {
        $configuration = new Configuration();

        self::assertEquals(CopyPasteDotEnvGenerator::class, $configuration->getStrategyClass());
    }

    public function testItThrowsExceptionWhenStrategyDoesNotExist()
    {
        $this->expectException(InvalidConfigurationException::class);

        new Configuration([
            'dot-env-parameter-handler' => [
                'strategy' => 'nonexistingstrategy'
            ]
        ]);
    }
}
