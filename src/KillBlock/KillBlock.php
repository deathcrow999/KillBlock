<?php

namespace KillBlock;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\math\Vector3;

use pocketmine\block\Block;

use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class KillBlock extends PluginBase implements Listener{

	public $killedByBlock = false;
	public $config;

	public function onEnable(){
		# Config
		@mkdir($this->getDataFolder());
		if(file_exists($this->getDataFolder()."config.yml")){
			$this->getLogger()->info('Using existing config file');
			$this->config = new Config($this->getDataFolder()."config.yml", Config::YAML);
		}else{
			$this->getLogger()->info('Creating new config file');
			$defaults = array(
				"killblock-id" => Block::EMERALD_BLOCK,
				"death-message" => "{player} died from standing on {killblock}",
				"use-custom-death-message" => true
				# Add here the default values.
				);
			$this->config = new Config($this->getDataFolder()."config.yml", Config::YAML, $defaults);
		}
		# Config ^
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TextFormat::GREEN . "Loaded");
	}

	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
                $player->kill();
		$block = $player->getLevel()->getBlock(new Vector3($player->getFloorX(), $player->getFloorY() - 1, $player->getFloorZ()));

    $sender->sendMessage(TextFormat::RED."Mind the fall!");

        	if($block->getId() === Block::EMERALD_BLOCK){
			$player->kill();
			if($this->config->get('use-custom-death-message')) $this->killedByBlock = true;
			// Should call PlayerDeathEvent
		}
	}
	
	public function onDeath(PlayerDeathEvent $event){
		if(!$this->killedByBlock) return;
		$this->killedByBlock = false;
		$event->setDeathMessage(null);
		$this->getServer()->broadcastMessage($this->getCustomMessage($event->getEntity()));
	}
	
	public function getCustomMessage(Player $player){
		$msg = $this->config->get('death-message');
		$msg = str_replace('{player}', $player->getName(), $msg);
		$msg = str_replace('{killblock}', strtolower(Block::get($this->config->get('killblock-id'))->getName()), $msg;
		return $msg;
	}
}
