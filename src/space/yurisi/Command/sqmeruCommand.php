<?php


namespace space\yurisi\Command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use space\yurisi\Form\MainForm;

class sqmeruCommand extends Command {

	/**
	 * sqmeruCommand constructor.
	 */
	public function __construct() {
		parent::__construct("sqmeru","きのこの里に投票しましょう","/sqmeru");
	}

	/**
	 * @param CommandSender $sender
	 * @param string $commandLabel
	 * @param string[] $args
	 *
	 * @return mixed
	 */
	public function execute(CommandSender $sender, string $commandLabel, array $args) {
		if($sender instanceof Player) $sender->sendForm(new MainForm());
		return true;
	}
}