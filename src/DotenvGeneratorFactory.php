<?php

namespace DotenvParameterHandler;

use Composer\IO\IOInterface;
use DotenvParameterHandler\DotenvGenerator\CopyPasteDotenvGenerator;
use DotenvParameterHandler\DotenvGenerator\InputDotenvGenerator;
use DotenvParameterHandler\Exception\InvalidConfigurationException;

class DotenvGeneratorFactory
{
    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @var array
     */
    private $availableStrategies = [
        Configuration::STRATEGY_COPY,
        Configuration::STRATEGY_INPUT,
        Configuration::STRATEGY_INPUT_OR_COPY
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
     * @return DotenvGenerator
     * @throws InvalidConfigurationException
     */
    public function create($strategy)
    {
        switch ($strategy) {
            case Configuration::STRATEGY_COPY:
                return new CopyPasteDotenvGenerator();
                break;
            case Configuration::STRATEGY_INPUT:
                return new InputDotenvGenerator($this->io);
                break;
            case Configuration::STRATEGY_INPUT_OR_COPY:
                if ($this->io->isInteractive()) {
                    return new InputDotenvGenerator($this->io);
                }

                return new CopyPasteDotenvGenerator();
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
