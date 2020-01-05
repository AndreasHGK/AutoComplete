<?php

declare(strict_types=1);

namespace AndreasHGK\AutoComplete;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;

class PacketListener implements Listener {

    public function onPacketSend(DataPacketSendEvent $ev) : void {
        $packet = $ev->getPacket();
        if(!$packet instanceof AvailableCommandsPacket) return;
        AutoComplete::getInstance()->updatePacketFor($ev->getPlayer(), $packet);
        \Closure::bind(function () use($packet) {
            $this->packet = $packet;
        }, $ev, DataPacketSendEvent::class)();
        var_dump($packet);
    }

}