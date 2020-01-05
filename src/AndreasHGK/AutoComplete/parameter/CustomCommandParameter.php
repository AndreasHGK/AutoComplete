<?php

declare(strict_types=1);

namespace AndreasHGK\AutoComplete\parameter;

use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use pocketmine\network\mcpe\protocol\types\CommandParameter;

class CustomCommandParameter {

    public const ARG_TYPE_INT             = 0x01;
    public const ARG_TYPE_FLOAT           = 0x02;
    public const ARG_TYPE_VALUE           = 0x03;
    public const ARG_TYPE_WILDCARD_INT    = 0x04;
    public const ARG_TYPE_OPERATOR        = 0x05;
    public const ARG_TYPE_TARGET          = 0x06;

    public const ARG_TYPE_FILEPATH = 0x0e;

    public const ARG_TYPE_STRING   = 0x1d;

    public const ARG_TYPE_POSITION = 0x25;

    public const ARG_TYPE_MESSAGE  = 0x29;

    public const ARG_TYPE_RAWTEXT  = 0x2b;

    public const ARG_TYPE_JSON     = 0x2f;

    public const ARG_TYPE_COMMAND  = 0x36;

    public const ARG_TYPE_ARRAY = 0x200000;

    //magic types
    public const MAGIC_TYPE_ITEM = "Item";
    public const MAGIC_TYPE_BLOCK = "Block";

    /** @var string */
    protected $name;

    /** @var int */
    protected $type = 0;

    /** @var bool */
    protected $optional = false;

    /**
     * @return string
     */
    public function getName() : string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) : void {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getType() : int {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type) : void {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isOptional() : bool {
        return $this->optional;
    }

    /**
     * @param bool $optional
     */
    public function setOptional(bool $optional) : void {
        $this->optional = $optional;
    }

    /**
     * @return CommandParameter
     */
    public function toPMParameter() : CommandParameter {
        $param = new CommandParameter();
        $param->paramName = $this->getName();
        $param->isOptional = $this->isOptional();
        $param->paramType = AvailableCommandsPacket::ARG_FLAG_VALID | $this->getType();
        return $param;
    }

    /**
     * AbstractCommandParameter constructor.
     * @param string $name
     * @param int $type
     * @param bool $optional
     */
    public function __construct(string $name, $type = self::ARG_TYPE_INT, bool $optional = false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->optional = $optional;
    }

}