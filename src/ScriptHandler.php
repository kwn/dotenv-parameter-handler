<?php

namespace DotenvParameterHandler;

use Composer\Script\Event;
use DotenvParameterHandler\DotenvParser\SymfonyDotenvParser;
use DotenvParameterHandler\Exception\DotenvParserException;
use DotenvParameterHandler\Exception\InvalidConfigurationException;

class ScriptHandler
{
    /**
     * @param Event $event
     *
     * @throws InvalidConfigurationException
     * @throws DotenvParserException
     */
    public static function buildParameters(Event $event)
    {
        $extras = $event->getComposer()->getPackage()->getExtra();
        $io = $event->getIO();

        $configuration = new Configuration($extras);
        $parser = new SymfonyDotenvParser();
        $generatorFactory = new DotenvGeneratorFactory($io);
        $generator = $generatorFactory->create($configuration->getStrategy());

        $io->write(sprintf('<info>Creating "%s" file...</info>', $configuration->getTargetFilename()));

        $data = $parser->parse($configuration->getSource());
        $content = $generator->generate($data);

        file_put_contents($configuration->getTarget(), $content);
    }
}
