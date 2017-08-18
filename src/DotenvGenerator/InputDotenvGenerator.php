<?php

namespace DotenvParameterHandler\DotenvGenerator;

use Composer\IO\IOInterface;
use DotenvParameterHandler\DotenvGenerator;

class InputDotenvGenerator implements DotenvGenerator
{
    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @param IOInterface $io
     */
    public function __construct(IOInterface $io)
    {
        $this->io = $io;
    }

    /**
     * @param array $dotEnv
     *
     * @return string
     */
    public function generate(array $dotEnv)
    {
        $content = '';

        foreach ($dotEnv as $key => $default) {
            $value = $this->io->ask(
                sprintf('<question>%s</question> (<comment>%s</comment>): ', $key, $default),
                $default
            );

            $content .= $key . '=' . $value . PHP_EOL;
        }

        return $content;
    }
}
