<?php

namespace MasterF\PMFrame\Object;

use pocketmine\level\Level;


class PFLevel {


  public function __construct(Level $level) {
    $this->level = $level;
  }

  public function getPlayers() {
    foreach($this->level->getPlayers() as $player) {
      $players[] = new PFPlayer($player);
    }

    return new PFArray($players);
  }

  public function getRandomPlayers($limit = 0) {
    $selPlayers = [];
    $data = 0;

    $players = $this->level->getPlayers();
    $pCount = count($players);

    $limit = $limit > $pCount ? $pCount : $limit;

    while(!$data < $limit) {

      $player = $players[mt_rand(0, $pCount-1)];

      $flag = true;

      foreach($players as $p) {
        if($p === $player) $flag = false;
      }

      if($flag) {
        $data++;
        $selPlayers[] = $player;
      }

    }

    return new PFArray($selPlayers);

  }

  public function getPlayerCounts() {

  }

  public function sendMessage($msg = "") {
    $this->getPlayers()->each(function($player) use ($msg) {
      $player->sendMessage($msg);
    });
  }

  public function sendTip($msg = "") {
    $this->getPlayers()->each(function($player) use ($msg) {
      $player->sendTip($msg);
    });
  }

  public function sendPopup($msg = "") {
    $this->getPlayers()->each(function($player) use ($msg) {
      $player->sendPopup($msg);
    });
  }

}
