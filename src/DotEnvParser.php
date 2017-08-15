<?php

namespace DotEnvParameterHandler;

use DotEnvParameterHandler\Exception\DotEnvParserException;

interface DotEnvParser
{
    /**
     * @param string $path
     *
     * @return array
     * @throws DotEnvParserException
     */
    public function parse($path);
}
