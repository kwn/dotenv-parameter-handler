<?php

namespace DotEnvParameterHandler;

class DotEnvGeneratorFactory
{
    /**
     * @param $strategyClass
     *
     * @return DotEnvGenerator
     */
    public function create($strategyClass)
    {
        return new $strategyClass;
    }
}
