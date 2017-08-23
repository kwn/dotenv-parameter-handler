<?php

namespace DotenvParameterHandler;

use Composer\IO\IOInterface;
use DotenvParameterHandler\DotenvGenerator\CopyPasteDotenvGenerator;
use DotenvParameterHandler\DotenvGenerator\InputDotenvGenerator;
use DotenvParameterHandler\Exception\InvalidConfigurationException;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class DotenvGeneratorFactoryTest extends TestCase
{
    /**
     * @var IOInterface|MockInterface
     */
    private $io;

    /**
     * @var DotenvGeneratorFactory
     */
    private $dotEnvGeneratorFactory;

    public function setUp()
    {
        $this->io = \Mockery::mock(IOInterface::class);
        $this->dotEnvGeneratorFactory = new DotenvGeneratorFactory($this->io);
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

    public function testItCreatesInputDotenvGeneratorWhenIoIsInteractive()
    {
        $this->io->shouldReceive('isInteractive')->andReturn(true);
        $generator = $this->dotEnvGeneratorFactory->create(Configuration::STRATEGY_INPUT_OR_COPY);

        self::assertInstanceOf(InputDotenvGenerator::class, $generator);
    }

    public function testItCreatesCopyPasteDotenvGeneratorWhenIoIsNotInteractive()
    {
        $this->io->shouldReceive('isInteractive')->andReturn(false);
        $generator = $this->dotEnvGeneratorFactory->create(Configuration::STRATEGY_INPUT_OR_COPY);

        self::assertInstanceOf(CopyPasteDotenvGenerator::class, $generator);
    }
}
