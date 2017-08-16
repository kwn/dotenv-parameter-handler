<?php

namespace DotEnvParameterHandler;

use Composer\IO\IOInterface;
use DotEnvParameterHandler\Exception\InvalidConfigurationException;
use PHPUnit\Framework\TestCase;

class DotEnvGeneratorFactoryTest extends TestCase
{
    /**
     * @var DotEnvGeneratorFactory
     */
    private $dotEnvGeneratorFactory;

    public function setUp()
    {
        $io = \Mockery::mock(IOInterface::class);

        $this->dotEnvGeneratorFactory = new DotEnvGeneratorFactory($io);
    }

    public function testItThrowsExceptionWhenStrategyDoesNotExist()
    {
        $this->expectException(InvalidConfigurationException::class);

        $this->dotEnvGeneratorFactory->create('non-existing-strategy');
    }
}
