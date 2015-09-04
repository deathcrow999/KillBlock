<?php

namespace KillBlock;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;

use pocketmine\block\Block;

use pocketmine\utils\TextFormat;

class KillBlock extends PluginBase implements Listener{

	public $killedByBlock = false;

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TextFormat::GREEN . "KillBlock has been turned on!!!");
	}

	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
		$block = $player->getLevel()->getBlock($player->floor()->subtract(0, 1));
        	if($block->getId() === Block::EMERALD_BLOCK){
            		$player->teleport($player->floor()->add(0, 50));
            		$this->getLogger()->info(TextFormat::RED . "Teleported! Plugin is working.");
		}
	}
}
