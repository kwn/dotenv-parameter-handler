<?php

namespace DotenvParameterHandler\DotenvGenerator;

use Composer\IO\IOInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class InputDotenvGeneratorTest extends TestCase
{
    /**
     * @var InputDotenvGenerator
     */
    private $dotEnvGenerator;

    /**
     * @var IOInterface|MockInterface
     */
    private $io;

    public function setUp()
    {
        $this->io = \Mockery::mock(IOInterface::class);
        $this->dotEnvGenerator = new InputDotenvGenerator($this->io);
    }

    public function testItGeneratesDotenvFileContentFromArrayWithDefaultValues()
    {
        $dotEnvArray = [
            'PARAMETER_1' => 'value1',
            'PARAMETER_2' => 'value2',
            'PARAMETER_3' => 'value3',
            'PARAMETER_4' => 'value4',
        ];

        $this->io->shouldReceive('ask')->with(\Mockery::type('string'), 'value1')->andReturn('value1');
        $this->io->shouldReceive('ask')->with(\Mockery::type('string'), 'value2')->andReturn('value2');
        $this->io->shouldReceive('ask')->with(\Mockery::type('string'), 'value3')->andReturn('value3');
        $this->io->shouldReceive('ask')->with(\Mockery::type('string'), 'value4')->andReturn('value4');

        $expectedContent = <<<CONTENT
PARAMETER_1=value1
PARAMETER_2=value2
PARAMETER_3=value3
PARAMETER_4=value4

CONTENT;

        self::assertEquals($expectedContent, $this->dotEnvGenerator->generate($dotEnvArray));
    }

    public function testItGeneratesDotenvFileContentFromArrayWithOverriddenValues()
    {
        $dotEnvArray = [
            'PARAMETER_1' => 'value1',
            'PARAMETER_2' => 'value2',
            'PARAMETER_3' => 'value3',
            'PARAMETER_4' => 'value4',
        ];

        $this->io->shouldReceive('ask')->with(\Mockery::type('string'), 'value1')->andReturn('value1');
        $this->io->shouldReceive('ask')->with(\Mockery::type('string'), 'value2')->andReturn('value2');
        $this->io->shouldReceive('ask')->with(\Mockery::type('string'), 'value3')->andReturn('test111');
        $this->io->shouldReceive('ask')->with(\Mockery::type('string'), 'value4')->andReturn('test222');

        $expectedContent = <<<CONTENT
PARAMETER_1=value1
PARAMETER_2=value2
PARAMETER_3=test111
PARAMETER_4=test222

CONTENT;

        self::assertEquals($expectedContent, $this->dotEnvGenerator->generate($dotEnvArray));
    }
}
