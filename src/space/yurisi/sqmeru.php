<?php


namespace space\yurisi;


use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use space\yurisi\Command\sqmeruCommand;

class sqmeru extends PluginBase{

	/**
	 * @var Config
	 */
	private static $config;


	public function onEnable() {
		Server::getInstance()->getCommandMap()->register("sqmeru",new sqmeruCommand());
		self::$config = new Config($this->getDataFolder() . "data.yml", Config::YAML, array());
	}

	public static function getData():Config {
		return self::$config;
	}



}