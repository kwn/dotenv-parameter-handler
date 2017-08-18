<?php

namespace DotenvParameterHandler\DotenvGenerator;

use DotenvParameterHandler\DotenvGenerator;

class CopyPasteDotenvGenerator implements DotenvGenerator
{
    /**
     * @param array $dotEnv
     *
     * @return string
     */
    public function generate(array $dotEnv)
    {
        $content = '';

        foreach ($dotEnv as $key => $value) {
            $content .= $key . '=' . $value . PHP_EOL;
        }

        return $content;
    }
}
