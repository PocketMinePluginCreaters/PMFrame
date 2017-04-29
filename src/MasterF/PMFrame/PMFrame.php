<?php

namespace MasterF\PMFrame;

use MasterF\PMFrame\Object\PFServer;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\Level;
use MasterF\PMFrame\Object\PFEvent;


class PMFrame {

  static $db = [];
  static $eventListener = null;

  public static function PF($obj = null, $args = null) {

    $instanceList = [
      "pocketmine\Player"      => "MasterF\PMFrame\Object\PFPlayer",
      "pocketmine\Server"      => "MasterF\PMFrame\Object\PFServer",
      "pocketmine\level\Level" => "MasterF\PMFrame\Object\PFLevel",

    ];

    if($obj === null) return new PFServer(Server::getInstance());

//    if(is_callable($obj)) return new PFThread($obj, $args);

    foreach($instanceList as $instance => $pfInst) {

      if($obj instanceof $instance) {
        // echo $instance;
        return new $pfInst($obj);
      }

    }

    return null;
  }

  public static function eventRegister($plugin) {
    self::$eventListener = new PFEvent($plugin);
  }

  public static function addEventListener($event, $func) {
    if(self::$eventListener === null)return false;

    self::$eventListener->add($event, $func);
  }

}
