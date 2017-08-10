<?php

namespace DotEnvParameterHandler\DotEnvGenerator;

use PHPUnit\Framework\TestCase;

class CopyPasteDotEnvGeneratorTest extends TestCase
{
    /**
     * @var CopyPasteDotEnvGenerator
     */
    private $dotEnvGenerator;

    public function setUp()
    {
        $this->dotEnvGenerator = new CopyPasteDotEnvGenerator();
    }

    public function testItGeneratesDotEnvFileContentFromArray()
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
