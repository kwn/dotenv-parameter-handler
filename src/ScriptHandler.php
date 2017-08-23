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

        $sourceData = $parser->parse($configuration->getSource());
        $targetData = [];
        $action = 'Creating';
        $existingContent = '';

        if (is_file($configuration->getTarget())) {
            $action = 'Updating';
            $existingContent = file_get_contents($configuration->getTarget());
            $targetData = $parser->parse($configuration->getTarget());
        }

        $io->write(sprintf('<info>%s "%s" file...</info>', $action, $configuration->getTargetFilename()));

        $dataMissingInTarget = array_diff_key($sourceData, $targetData);

        if (empty($dataMissingInTarget)) {
            $io->write(sprintf('<info>%s file is up to date...</info>', $configuration->getTargetFilename()));
            return;
        }

        $contentMissingInTarget = $generator->generate($dataMissingInTarget);

        file_put_contents($configuration->getTarget(), $existingContent . $contentMissingInTarget);
    }
}
