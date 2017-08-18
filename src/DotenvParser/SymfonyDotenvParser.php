<?php

namespace DotenvParameterHandler\DotenvParser;

use DotenvParameterHandler\DotenvParser;
use DotenvParameterHandler\Exception\DotenvParserException;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Dotenv\Exception\FormatException;

class SymfonyDotenvParser implements DotenvParser
{
    /**
     * @inheritdoc
     */
    public function parse($path)
    {
        if (!is_file($path)) {
            throw new DotenvParserException(sprintf('Cannot parse file. File "%s" does not exist.', $path));
        }

        $content = file_get_contents($path);

        try {
            $dotEnv = (new Dotenv())->parse($content, $path);
        } catch (FormatException $e) {
            throw new DotenvParserException($e->getMessage(), $e->getCode(), $e);
        }

        return $dotEnv;
    }
}
