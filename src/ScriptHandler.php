<?php

namespace DotEnvParameterHandler;

use Composer\Script\Event;
use DotEnvParameterHandler\DotEnvParser\SymfonyDotEnvParser;
use DotEnvParameterHandler\Exception\DotEnvParserException;
use DotEnvParameterHandler\Exception\InvalidConfigurationException;

class ScriptHandler
{
    /**
     * @param Event $event
     *
     * @throws InvalidConfigurationException
     * @throws DotEnvParserException
     */
    public static function buildParameters(Event $event)
    {
        $extras = $event->getComposer()->getPackage()->getExtra();
        $io = $event->getIO();

        $configuration = new Configuration($extras);
        $parser = new SymfonyDotEnvParser();
        $generatorFactory = new DotEnvGeneratorFactory($io);
        $generator = $generatorFactory->create($configuration->getStrategy());

        $io->write(sprintf('<info>Creating "%s" file...</info>', $configuration->getTargetFilename()));

        $data = $parser->parse($configuration->getSource());
        $content = $generator->generate($data);

        file_put_contents($configuration->getTarget(), $content);
    }
}
