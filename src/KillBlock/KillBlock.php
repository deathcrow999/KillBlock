<?php

namespace KillBlock;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageEvent;

use pocketmine\math\Vector3;

use pocketmine\block\Block;

use pocketmine\utils\TextFormat;

use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\CommandSender;

use pocketmine\Player;

use pocketmine\level\Level;
use pocketmine\level\Position;


class KillBlock extends PluginBase implements Listener{

	public $killedByBlock = false;

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TextFormat::GREEN . "KillBlock has been turned on!!!");
	}

	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
		$block = $event->getPlayer()->getLevel()->getBlock($player->floor()->subtract(0, 1));
		if($block instanceof Block){
			$id = $block->getId();
			if($id === Block::get("EMERALD_BLOCK")->getId()){
				$this->getLogger()->info(TextFormat::RED . "Teleported! Plugin is working.");
			}
		}
	}
}
