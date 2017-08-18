<?php

namespace DotenvParameterHandler;

interface DotenvGenerator
{
    /**
     * @param array $dotEnv
     *
     * @return string
     */
    public function generate(array $dotEnv);
}
