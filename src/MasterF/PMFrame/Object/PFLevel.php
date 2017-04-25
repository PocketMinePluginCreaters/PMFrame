<?php

namespace MasterF\PMFrame\Object;

use pocketmine\level\Level;
use pocketmine\level\Position;

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

  public function setBlockArea($from, $to, $block) {
    $max_x = max($from->x, $to->x);
    $max_y = max($from->y, $to->y);
    $max_z = max($from->z, $to->z);

    $min_x = min($from->x, $to->x);
    $min_y = min($from->y, $to->y);
    $min_z = min($from->z, $to->z);

    for($x = $min_x; $x <= $to->x; $x++) {

      for($y = $min_y; $y <= $to->y; $y++) {

        for($z = $min_z; $z <= $to->z; $z++) {
          $this->setBlock($block, new Position($x, $y, $z));
        }

      }

    }

  }

  public function eachBlockArea(callable $func, $from, $to) {
    $max_x = max($from->x, $to->x);
    $max_y = max($from->y, $to->y);
    $max_z = max($from->z, $to->z);

    $min_x = min($from->x, $to->x);
    $min_y = min($from->y, $to->y);
    $min_z = min($from->z, $to->z);

    for($x = $min_x; $x <= $to->x; $x++) {

      for($y = $min_y; $y <= $to->y; $y++) {

        for($z = $min_z; $z <= $to->z; $z++) {
          $func(new Position($x, $y, $z), $this->level);
        }

      }

    }
  }

  public function setBlock($pos, $block) {
    $this->level->setBlock($pos, $block);
  }

}
