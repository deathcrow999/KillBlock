<?php

namespace KillBlock;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\block\Block;
use pocketmine\utils\TextFormat;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\CommandSender;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;


class KillBlock extends PluginBase implements Listener{

public $killedByBlock = false;

public function onLoad(){
  $this->getLogger()->info("KillBlock is loaded!");
}
public function onEnable(){
  $this->getLogger()->info("KillBlock is on!");
  $this->getServer()->getPluginManager()->registerEvents($this, $this);
}

public function onMove(PlayerMoveEvent $ev){
$player = $ev->getPlayer();
  $block = $ev->getPlayer()->getLevel()->getBlock($ev->getPlayer()->floor()->subtract(0, 1));
  if($block->getId() === Block::EMERALD_BLOCK){


$player->teleport(new Position($x, $y, $z, $this->getServer()->getLevelByName("main")));
  }
}



}

?>
