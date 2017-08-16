<?php

namespace DotEnvParameterHandler;

use DotEnvParameterHandler\Exception\InvalidConfigurationException;

class Configuration
{
    const DEFAULT_STRATEGY = self::STRATEGY_COPYPASTE;

    const STRATEGY_COPYPASTE = 'copypaste';
    const STRATEGY_INPUT = 'input';

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
        if (isset($extraConfig['dot-env-parameter-handler'])) {
            $dotEnvConfig = $extraConfig['dot-env-parameter-handler'];

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
    public function getStrategy()
    {
        return $this->strategy;
    }
}
