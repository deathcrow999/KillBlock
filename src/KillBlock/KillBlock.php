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
                if($player->getLevel()->getBlockIdAt($player->getFloorX(), $player->getFloorY() -1, $player->getFloorZ()) === 138){
                $this->killedByBlock = true;
                $player->kill();
                }
        }
        
        public function onDeath(PlayerDeathEvent $event){
                $player = $event->getEntity();
                if($this->killedByBlock){
                        $this->getServer()->broadcastMessage($player->getName().' died from standing on emerald');
                        $this->killedByBlock = false;
                        $event->setDeathMessage(null);
                }
        }
}






?>
