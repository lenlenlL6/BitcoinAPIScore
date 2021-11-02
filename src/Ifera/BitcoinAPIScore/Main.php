<?php
declare(strict_types = 1);

namespace Ifera\BitcoinAPIScore;

use Ifera\BitcoinAPIScore\listeners\EventListener;
use Ifera\BitcoinAPIScore\listeners\TagResolveListener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	public function onEnable(){
	    $this->bitcoin = $this->getServer()->getPluginManager()->getPlugin("BitcoinAPI");

		$this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
		$this->getServer()->getPluginManager()->registerEvents(new TagResolveListener($this), $this);
	}
}