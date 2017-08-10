<?php

namespace DotEnvParameterHandler;

interface DotEnvParser
{
    /**
     * @param string $path
     *
     * @return array
     */
    public function parse($path);
}
