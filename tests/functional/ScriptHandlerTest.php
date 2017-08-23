<?php

namespace DotenvParameterHandler;

use Composer\IO\IOInterface;
use Composer\Script\Event;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class ScriptHandlerTest extends TestCase
{
    /**
     * @var IOInterface|MockInterface
     */
    private $io;

    /**
     * @var Event|MockInterface
     */
    private $event;

    public function setUp()
    {
        $this->io = \Mockery::mock(IOInterface::class);
        $this->io->shouldReceive('isInteractive')->andReturn(false);
        $this->io->shouldIgnoreMissing();

        $this->event = \Mockery::mock(Event::class);
        $this->event->shouldReceive('getComposer->getPackage->getExtra')->andReturn([
            'dotenv-parameter-handler' => [
                'source' => '.env1.dist',
                'target' => '.env'
            ]
        ]);
        $this->event->shouldReceive('getIO')->andReturn($this->io);

        chdir(__DIR__ . '/../fixtures');
    }

    public function testItBuildsParameters()
    {
        ScriptHandler::buildParameters($this->event);

        self::assertTrue(true);
    }
}
