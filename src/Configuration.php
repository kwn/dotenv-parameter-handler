<?php

namespace DotEnvParameterHandler;

use DotEnvParameterHandler\DotEnvGenerator\CopyPasteDotEnvGenerator;
use DotEnvParameterHandler\Exception\InvalidConfigurationException;

class Configuration
{
    const DEFAULT_STRATEGY = 'copypaste';

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
     * @var array
     */
    private $strategyMappings = [
        'copypaste' => CopyPasteDotEnvGenerator::class,
    ];

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
                if (!array_key_exists($dotEnvConfig['strategy'], $this->strategyMappings)) {
                    throw new InvalidConfigurationException(sprintf(
                        'Strategy "%s" is invalid. Available options: %s',
                        $dotEnvConfig['strategy'],
                        implode(', ', array_keys($this->strategyMappings))
                    ));
                }

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
    public function getStrategyClass()
    {
        return $this->strategyMappings[$this->strategy];
    }
}
