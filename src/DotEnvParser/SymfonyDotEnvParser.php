<?php

namespace DotEnvParameterHandler\DotEnvParser;

use DotEnvParameterHandler\DotEnvParser;
use DotEnvParameterHandler\Exception\DotEnvParserException;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Dotenv\Exception\FormatException;

class SymfonyDotEnvParser implements DotEnvParser
{
    /**
     * @inheritdoc
     */
    public function parse($path)
    {
        if (!is_file($path)) {
            throw new DotEnvParserException(sprintf('Cannot parse file. File "%s" does not exist.', $path));
        }

        $content = file_get_contents($path);

        try {
            $dotEnv = (new Dotenv())->parse($content, $path);
        } catch (FormatException $e) {
            throw new DotEnvParserException($e->getMessage(), $e->getCode(), $e);
        }

        return $dotEnv;
    }
}
