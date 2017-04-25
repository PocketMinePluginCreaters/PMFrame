<?php

namespace MasterF\PMFrame\Object;

use pocketmine\Server;
use pocketmine\scheduler\Task;

class PFServer {

  private $server;

  public function __construct(Server $server) {
    $this->server = $server;
  }

  public function getOnlinePlayers() {

    $players = [];

    foreach($this->server->getOnlinePlayers() as $player) {
      $players[] = new PFPlayer($player);
    }

    return new PFArray($players);
  }

  public function getLevels() {

    $levels = [];

    foreach($this->server->getLevels() as $level) {
      $levels[] = new PFLevel($level);
    }

    return new PFArray($levels);
  }

  public function registerEvents($listener, $plugin = null) {
    $plugin = $plugin ?? $listener;

    $this->server->getPluginManager()->registerEvents($listener, $plugin);
  }

  public function scheduleDelayedTask($task, $tick) {

    if(is_callable($task))
      $Ttask = new PFTask($task);
    else if($task instanceof Task)
     $Ttask = $task;
     else
    $Ttask = null;

    if($task === null) return false;

    $this->server->getScheduler()->scheduleDelayedTask($task, $tick);

    return true;
  }

  public function scheduleRepeatingTask($task, $tick) {
    // var_dump(is_callable($task));
    if(is_callable($task))
      $Ttask = new PFTask($task);
    else if($task instanceof Task)
     $Ttask = $task;
     else
    $Ttask = null;

    if($Ttask === null) return false;

    $this->server->getScheduler()->scheduleRepeatingTask($Ttask, $tick);

    return true;
  }

}
