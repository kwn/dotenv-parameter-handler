<?php

namespace DotEnvParameterHandler;

interface DotEnvGenerator
{
    /**
     * @param array $dotEnv
     *
     * @return string
     */
    public function generate(array $dotEnv);
}
