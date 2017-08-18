<?php

namespace DotenvParameterHandler\DotenvGenerator;

use PHPUnit\Framework\TestCase;

class CopyPasteDotenvGeneratorTest extends TestCase
{
    /**
     * @var CopyPasteDotenvGenerator
     */
    private $dotEnvGenerator;

    public function setUp()
    {
        $this->dotEnvGenerator = new CopyPasteDotenvGenerator();
    }

    public function testItGeneratesDotenvFileContentFromArray()
    {
        $dotEnvArray = [
            'PARAMETER_1' => 'value1',
            'PARAMETER_2' => 'value2',
            'PARAMETER_3' => 'value3',
            'PARAMETER_4' => 'value4',
        ];

        $expectedContent = <<<CONTENT
PARAMETER_1=value1
PARAMETER_2=value2
PARAMETER_3=value3
PARAMETER_4=value4

CONTENT;

        self::assertEquals($expectedContent, $this->dotEnvGenerator->generate($dotEnvArray));
    }
}
