<?php

namespace DotenvParameterHandler;

use DotenvParameterHandler\Exception\InvalidConfigurationException;

class Configuration
{
    const DEFAULT_STRATEGY = self::STRATEGY_COPY;

    const STRATEGY_COPY = 'copy';
    const STRATEGY_INPUT = 'input';
    const STRATEGY_INPUT_OR_COPY = 'input_or_copy';

    /**
     * @var string
     */
    private $source = '.env.dist';

    /**
     * @var string
     */
    private $target = '.env';

    /**
     * @var string
     */
    private $strategy = self::DEFAULT_STRATEGY;

    /**
     * @param array $extraConfig
     *
     * @throws InvalidConfigurationException
     */
    public function __construct(array $extraConfig = [])
    {
        if (isset($extraConfig['dotenv-parameter-handler'])) {
            $dotEnvConfig = $extraConfig['dotenv-parameter-handler'];

            if (isset($dotEnvConfig['source'])) {
                $this->source = $dotEnvConfig['source'];
            }

            if (isset($dotEnvConfig['target'])) {
                $this->target = $dotEnvConfig['target'];
            }

            if (isset($dotEnvConfig['strategy'])) {
                $this->strategy = $dotEnvConfig['strategy'];
            }
        }
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return getcwd() . DIRECTORY_SEPARATOR . $this->source;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return getcwd() . DIRECTORY_SEPARATOR . $this->target;
    }

    /**
     * @return string
     */
    public function getTargetFilename()
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }
}
