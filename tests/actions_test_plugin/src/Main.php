<?php

declare(strict_types=1);

namespace NxtLvLSoftware\actions_test;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	public function onEnable() : void {
		$this->getLogger()->info("Enabled!");
	}

	public function onDisable() : void {
		$this->getLogger()->info("Disabled!");
	}

	public function onJoin(PlayerJoinEvent $event) : void {
		$event->getPlayer()->sendMessage("Hello World!");
	}

}
