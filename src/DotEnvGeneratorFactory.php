<?php

namespace DotEnvParameterHandler;

use Composer\IO\IOInterface;
use DotEnvParameterHandler\DotEnvGenerator\CopyPasteDotEnvGenerator;
use DotEnvParameterHandler\DotEnvGenerator\InputDotEnvGenerator;
use DotEnvParameterHandler\Exception\InvalidConfigurationException;

class DotEnvGeneratorFactory
{
    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @var array
     */
    private $availableStrategies = [
        Configuration::STRATEGY_COPYPASTE,
        Configuration::STRATEGY_INPUT
    ];

    /**
     * @param IOInterface $io
     */
    public function __construct(IOInterface $io)
    {
        $this->io = $io;
    }

    /**
     * @param string $strategy
     *
     * @return DotEnvGenerator
     * @throws InvalidConfigurationException
     */
    public function create($strategy)
    {
        switch ($strategy) {
            case Configuration::STRATEGY_COPYPASTE:
                return new CopyPasteDotEnvGenerator();
                break;
            case Configuration::STRATEGY_INPUT:
                return new InputDotEnvGenerator($this->io);
                break;
            default:
                throw new InvalidConfigurationException(sprintf(
                    'Strategy "%s" is invalid. Available options: %s',
                    $strategy,
                    implode(', ', $this->availableStrategies)
                ));
        }
    }
}
