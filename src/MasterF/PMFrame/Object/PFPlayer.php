<?php

namespace MasterF\PMFrame\Object;

use pocketmine\Player;

use MasterF\PMFrame\PMFrame;
class PFPlayer {

  private $player;

  public function __construct(Player $player) {
    $this->player = $player;
  }

  public function getPlayer() {
    return $this->player;
  }

  public function getName() {
    return $this->player->getName();
  }

  public function getLevel() {
    return new PFLevel($this->player->level);
  }

  public function getNearPlayer() {
    $level = $this->player->level;

    $minDistance = -1;
    $nPlayer = null;

    foreach($level->getPlayers() as $player) {
      $x = $this->player->x - $player->x;
      $y = $this->player->y - $player->y;
      $z = $this->player->z - $player->z;

      $distance = $x**2 + $y**2 + $z**2;

      if($minDistance === -1 or $distance < $minDistance) {
        $minDistance = $distance;
        $nPlayer = $player;
      }

    }

    return $nPlayer !== null ? new PFPlayer($nPlayer) : null;
  }

  public function sendMessage($msg = "") {
    $this->player->sendMessage($msg);
  }

  public function sendPopup($msg = "") {
    $this->player->sendPopup($msg);
  }

  public function sendTip($msg = "") {
    $this->player->sendTip($msg);
  }

  public function sendDelayedMessage($msg = "", $tick = 20) {
    $player = $this;
    PMFrame::PF()->scheduleDelayedTask(function() use ($msg, $player) {
      $player->sendMessage($msg);
    }, $tick);
  }

  public function addItem($item) {
    $this->player->getInventory()->addItem($item);
  }

  public function removeItem($item) {
    $this->player->getInventory()->removeItem($item);
  }

  public function cleanHotbar($slot) {
    $inv = $this->player->getInventory();
    $inv->clear($inv->getHeldItemSlot());
  }

}
