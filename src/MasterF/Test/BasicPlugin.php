<?php

namespace MasterF\Test;

use pocketmine\plugin\PLuginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

use MasterF\PMFrame\PMFrame; //これの宣言のみでおｋ

class BasicPlugin extends PluginBase implements Listener{

  public function onEnable() {
    date_default_timezone_set("Asia/Tokyo");
    PMFrame::PF()->registerEvents($this);

    PMFrame::PF()->scheduleRepeatingTask(function() {
      PMFrame::PF()->getOnlinePlayers()->each(function($player) {
        $player->sendPopup(date("Y-m-d H:i:s"));
        // $player->addItem();
      });
    }, 20);

    PMFrame::SQLite(new \SQLite3("C:\data.sqlite3"), "famima");
    PMFrame::getDB("famima")->create("plugin", ["plugin" => ["data", "int"]]);
  }

  public function onJoin(PlayerJoinEvent $ev) {
    $player = PMFrame::PF($ev->getPlayer());//こんな感じ
    $player->getLevel()->sendTip($player->getName()."がログインしました");

  }

}
