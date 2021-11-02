<?php
declare(strict_types = 1);

namespace Ifera\BitcoinAPIScore\listeners;

use Ifera\BitcoinAPIScore\Main;
use Ifera\ScoreHud\event\PlayerTagUpdateEvent;
use Ifera\ScoreHud\scoreboard\ScoreTag;
use BitcoinAPI\BitcoinChangeEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use function is_null;
use function strval;

class EventListener implements Listener{

	/** @var Main */
	private $plugin;

	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}

	public function onBitcoinChange(BitcoinChangeEvent $event){
		$username = $event->getPlayer()->getName();

		if(is_null($username)){
			return;
		}

		$player = $this->plugin->getServer()->getPlayer($username);

		if($player instanceof Player && $player->isOnline()){
			(new PlayerTagUpdateEvent($player, new ScoreTag("score.bitcoin", strval($event->getBitcoin()))))->call();
		}
	}
}
