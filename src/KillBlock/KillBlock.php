<?php

namespace KillBlock;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerMoveEvent;

class KillBlock extends PluginBase implements Listener{
public function onLoad(){
  $this->getLogger()->info("KillBlock is loaded!");
}
public function onEnable(){
  $this->getLogger()->info("KillBlock is on!");
  $this->getServer()->getPluginManager()->registerEvents($this, $this);
}

public function onMove(PlayerMoveEvent $event){
  $player = $event->getPlayer();

  if($player->getLevel()->getBlock(new Vector3($player->getFloorX(), $player->getFloorY() - 1, $player->getFloorZ()))->getId() === 133){
   $player->kill();
  }
}
}




?>
