<?php

namespace DotenvParameterHandler;

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function testItReturnsDotenvSource()
    {
        $configuration = new Configuration([
            'dotenv-parameter-handler' => [
                'source' => '.env.example'
            ]
        ]);

        self::assertEquals(getcwd() . DIRECTORY_SEPARATOR . '.env.example', $configuration->getSource());
    }

    public function testItHasDefaultValueForDotenvSource()
    {
        $configuration = new Configuration();

        self::assertEquals(getcwd() . DIRECTORY_SEPARATOR . '.env.dist', $configuration->getSource());
    }

    public function testItReturnsDotenvTarget()
    {
        $configuration = new Configuration([
            'dotenv-parameter-handler' => [
                'target' => '.envdest'
            ]
        ]);

        self::assertEquals(getcwd() . DIRECTORY_SEPARATOR . '.envdest', $configuration->getTarget());
    }

    public function testItHasDefaultValueForDotenvTarget()
    {
        $configuration = new Configuration();

        self::assertEquals(getcwd() . DIRECTORY_SEPARATOR . '.env', $configuration->getTarget());
    }

    public function testItReturnsDotenvTargetFilename()
    {
        $configuration = new Configuration([
            'dotenv-parameter-handler' => [
                'target' => '.envdest'
            ]
        ]);

        self::assertEquals('.envdest', $configuration->getTargetFilename());
    }

    public function testItReturnsStrategy()
    {
        $configuration = new Configuration([
            'dotenv-parameter-handler' => [
                'strategy' => 'input'
            ]
        ]);

        self::assertEquals('input', $configuration->getStrategy());
    }

    public function testItHasDefaultValueForDotenvStrategy()
    {
        $configuration = new Configuration();

        self::assertEquals(Configuration::DEFAULT_STRATEGY, $configuration->getStrategy());
    }
}
