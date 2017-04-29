<?php

namespace MasterF\Test;

use MasterF\PMFrame\Object\PFPlayer;
use pocketmine\Player;
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
//    PMFrame::PF()->registerEvents($this);

    PMFrame::eventRegister($this);
    PMFrame::addEventListener("pocketmine\\event\\player\\PlayerMoveEvent",
        function($ev) {
            PMFrame::PF($ev->getPlayer())->sendMessage("はろー！初めまして\nこれはPMFrameだよ", 20);
        }
    );

    
    PMFrame::PF()->scheduleRepeatingTask(function() {
      PMFrame::PF()->getOnlinePlayers()->each(function(Player $player) {
        $player->sendPopup(date("Y-m-d H:i:s")."\n");

        // $player->addItem(Item::get(1, 0, 1));
      });
    }, 20);

    /*PMFrame::SQLite(new \SQLite3("C:\data.sqlite3"), "famima");
    PMFrame::getDB("famima")->create("plugin", ["plugin" => ["data", "int"]]); */
  }


  /*public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {

  }*/

}
