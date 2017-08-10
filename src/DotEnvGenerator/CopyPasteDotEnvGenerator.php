<?php

namespace DotEnvParameterHandler\DotEnvGenerator;

use DotEnvParameterHandler\DotEnvGenerator;

class CopyPasteDotEnvGenerator implements DotEnvGenerator
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
