<?php
	
	/**
	 * @name MyPlugin
	 * @main somedude\killblock\KillBlock
	 * @version 1.0.0
	 * @api 1.12.0
	 * @description My super plugin
	 * @author authorName
	 */
	
	
	//If you want to use multiple namespaces per file you've to use this.
namespace somedude\killblock{

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\block\Block;

class KillBlock extends PluginBase implements Listener {

	public $killedByBlock = false;

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
		if($player->getLevel()->getBlockIdAt($player->getFloorX(), $player->getFloorY() -1, $player->getFloorZ()) === Block::OBSIDIAN){
		$this->killedByBlock = true;
		$player->kill();
		}
	}
	
	public function onDeath(PlayerDeathEvent $event){
		$player = $event->getEntity();
		if($this->killedByBlock){
			$this->getServer()->broadcastMessage($player->getName().' died from standing on obsidian');
			$this->killedByBlock = false;
			$event->setDeathMessage(null);
		}
	}
}


}
