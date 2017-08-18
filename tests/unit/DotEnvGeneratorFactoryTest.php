<?php

namespace DotenvParameterHandler;

use Composer\IO\IOInterface;
use DotenvParameterHandler\DotenvGenerator\CopyPasteDotenvGenerator;
use DotenvParameterHandler\DotenvGenerator\InputDotenvGenerator;
use DotenvParameterHandler\Exception\InvalidConfigurationException;
use PHPUnit\Framework\TestCase;

class DotenvGeneratorFactoryTest extends TestCase
{
    /**
     * @var DotenvGeneratorFactory
     */
    private $dotEnvGeneratorFactory;

    public function setUp()
    {
        $io = \Mockery::mock(IOInterface::class);

        $this->dotEnvGeneratorFactory = new DotenvGeneratorFactory($io);
    }

    public function testItThrowsExceptionWhenStrategyDoesNotExist()
    {
        $this->expectException(InvalidConfigurationException::class);

        $this->dotEnvGeneratorFactory->create('non-existing-strategy');
    }

    public function testItCreatesCopyPasteDotenvGenerator()
    {
        $generator = $this->dotEnvGeneratorFactory->create(Configuration::STRATEGY_COPY);

        self::assertInstanceOf(CopyPasteDotenvGenerator::class, $generator);
    }

    public function testItCreatesInputDotenvGenerator()
    {
        $generator = $this->dotEnvGeneratorFactory->create(Configuration::STRATEGY_INPUT);

        self::assertInstanceOf(InputDotenvGenerator::class, $generator);
    }
}
