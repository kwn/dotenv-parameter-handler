<?php

namespace DotEnvParameterHandler\DotEnvParser;

use DotEnvParameterHandler\Exception\DotEnvParserException;
use PHPUnit\Framework\TestCase;

class SymfonyDotEnvParserTest extends TestCase
{
    /**
     * @var SymfonyDotEnvParser
     */
    private $dotEnvParser;

    public function setUp()
    {
        $this->dotEnvParser = new SymfonyDotEnvParser();
    }

    public function testItParsesDotEnvFile()
    {
        self::assertEquals([
            'DB_HOST' => '127.0.0.1',
            'DB_PORT' => '3306',
            'DB_DATABASE' => 'testdb',
            'DB_USERNAME' => 'testuser',
            'DB_PASSWORD' => 'testpass'
        ], $this->dotEnvParser->parse(__DIR__ . '/../../fixtures/.env1.dist'));
    }

    public function testItThrowsExceptionWhenFileDoesNotExist()
    {
        $this->expectException(DotEnvParserException::class);

        $this->dotEnvParser->parse(__DIR__ . '/../../fixtures/non_existing_file.txt');
    }

    public function testItThrowsExceptionWhenFileHasSyntaxError()
    {
        $this->expectException(DotEnvParserException::class);

        $this->dotEnvParser->parse(__DIR__ . '/../../fixtures/.env2.dist');
    }
}
