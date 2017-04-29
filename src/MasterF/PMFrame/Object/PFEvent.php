<?php

namespace MasterF\PMFrame\Object;

use MasterF\PMFrame\PMFrame;
use pocketmine\event\listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\plugin\PluginBase;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Event;

class PFEvent implements Listener {

    private $function;

    public function __construct(PluginBase $plugin) {
        PMFrame::PF()->registerEvents($this, $plugin);
    }


    public function onEvent(Event $ev) {

        foreach($this->function as $event => $functions) {

            if($ev instanceof  $event) {

                foreach($functions as $func) {
                    $func($ev);
                }

            }
        }

    }


    public function onJoin(PlayerJoinEvent $ev) {
        $this->onEvent($ev);
    }

    public function onQuit(PlayerQuitEvent $ev) {
        $this->onEvent($ev);
    }

    public function onChat(PlayerChatEvent $ev) {
        $this->onEvent($ev);
    }

    public function onMove(PlayerMoveEvent $ev) {
        $this->onEvent($ev);
    }


    public function onLogin(PlayerLoginEvent $ev) {
        $this->onEvent($ev);
    }

    public function onPreLogin(PlayerPreLoginEvent $ev) {
        $this->onEvent($ev);
    }

    public function onDeath(PlayerDeathEvent $ev) {
        $this->onEvent($ev);
    }

    public function onItemHeld(PlayerItemHeldEvent $ev) {
        $this->onEvent($ev);
    }

    public function onPlayerRespawn(PlayerRespawnEvent $ev) {
        $this->onEvent($ev);
    }

    public function add($event, $func) {
        $this->function[$event][] = $func;

    }
}
