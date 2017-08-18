<?php

namespace DotEnvParameterHandler;

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

    public function testItReturnsDotEnvTargetFilename()
    {
        $configuration = new Configuration([
            'dot-env-parameter-handler' => [
                'target' => '.envdest'
            ]
        ]);

        self::assertEquals('.envdest', $configuration->getTargetFilename());
    }

    public function testItReturnsStrategy()
    {
        $configuration = new Configuration([
            'dot-env-parameter-handler' => [
                'strategy' => 'input'
            ]
        ]);

        self::assertEquals('input', $configuration->getStrategy());
    }

    public function testItHasDefaultValueForDotEnvStrategy()
    {
        $configuration = new Configuration();

        self::assertEquals(Configuration::DEFAULT_STRATEGY, $configuration->getStrategy());
    }
}
