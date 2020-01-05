<?php

declare(strict_types=1);

namespace AndreasHGK\AutoComplete;

use AndreasHGK\AutoComplete\parameter\CustomCommandParameter;
use pocketmine\command\Command;

class CustomCommandData {

    /** @var Command */
    protected $command;

    /** @var array|ParameterMap[] */
    protected $parameters = [];

    /**
     * @return string
     */
    public function getName() : string {
        return $this->command->getLabel();
    }

    /**
     * @return Command
     */
    public function getCommand() : Command {
        return $this->command;
    }

    /**
     * @param $x
     * @param $y
     * @return bool
     */
    public function parameterExists($x, $y) : bool {
        return $this->parameters[$x][$y] !== null;
    }

    /**
     * @param int $x
     * @param int $y
     * @return CustomCommandParameter|null
     */
    public function getParameter(int $x, int $y) : ?CustomCommandParameter {
        if(!isset($this->parameters[$x])) return null;
        return $this->parameters[$x][$y] ?? null;
    }

    /**
     * @param int $x
     * @param int $y
     * @param CustomCommandParameter $param
     */
    public function setParameter(int $x, int $y, CustomCommandParameter $param) : void {
        if(!isset($this->parameters[$x])) $this->parameters[$x] = new ParameterMap($this);
        $this->parameters[$x][$y] = $param;
    }

    /**
     * @param $x
     * @return ParameterMap
     */
    public function getParameterMap($x) : ParameterMap {
        return $this->parameters[$x];
    }

    /**
     * @param $x
     * @param ParameterMap $map
     */
    public function setParamaterMap($x, ParameterMap $map) : void {
        $this->parameters[$x] = $map;
    }

    /**
     * @return array|ParameterMap[]
     */
    public function getParameters() : array {
        return $this->parameters;
    }

    /**
     * @param array|ParameterMap[] $parameters
     */
    public function setParameters(array $parameters) : void {
        $this->parameters = $parameters;
    }

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

}