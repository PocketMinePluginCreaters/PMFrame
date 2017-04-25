<?php

namespace MasterF\PMFrame;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\Level;

use MasterF\PMFrame\Object\{PFPlayer, PFServer, PFSQLite3};

class PMFrame {

  static $db = [];

  public static function PF($obj = null) {

    $instanceList = [
      "pocketmine\Player"      => "MasterF\PMFrame\Object\PFPlayer",
      "pocketmine\Server"      => "MasterF\PMFrame\Object\PFServer",
      "pocketmine\level\Level" => "MasterF\PMFrame\Object\PFLevel",

    ];

    if($obj === null) return new PFServer(Server::getInstance());

    foreach($instanceList as $instance => $pfInst) {
      if($obj instanceof $instance) {
        // echo $instance;
        return new $pfInst($obj);
      }

    }

    return null;
  }


}
