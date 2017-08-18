<?php

namespace DotenvParameterHandler;

use DotenvParameterHandler\Exception\DotenvParserException;

interface DotenvParser
{
    /**
     * @param string $path
     *
     * @return array
     * @throws DotenvParserException
     */
    public function parse($path);
}
