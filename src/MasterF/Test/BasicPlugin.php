<?php

namespace MasterF\Test;

use pocketmine\plugin\PLuginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\block\Block;
use pocketmine\level\Position;
use pocketmine\item\Item;

use pocketmine\command\{Command, CommandSender};
use MasterF\PMFrame\PMFrame; //これの宣言のみでおｋ

class BasicPlugin extends PluginBase implements Listener{

  public function onEnable() {
    date_default_timezone_set("Asia/Tokyo");
    PMFrame::PF()->registerEvents($this);

    PMFrame::PF()->scheduleRepeatingTask(function() {
      PMFrame::PF()->getOnlinePlayers()->each(function($player) {
        $player->sendPopup(date("Y-m-d H:i:s"));
        // $player->addItem(Item::get(1, 0, 1));
      });
    }, 20);

    /*PMFrame::SQLite(new \SQLite3("C:\data.sqlite3"), "famima");
    PMFrame::getDB("famima")->create("plugin", ["plugin" => ["data", "int"]]); */
  }

  public function onJoin(PlayerJoinEvent $ev) {
    $pfPlayer = PMFrame::PF($ev->getPlayer());
    $name = $pfPlayer->getName();
    $pfPlayer->getLevel()->sendTip("Login: ${name}");
  }


  /*public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {

  }*/

}
