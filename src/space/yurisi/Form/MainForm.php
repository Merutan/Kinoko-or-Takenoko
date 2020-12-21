<?php


namespace space\yurisi\Form;


use pocketmine\form\Form;
use pocketmine\Player;
use space\yurisi\Item\SpecialBook;
use space\yurisi\sqmeru;

class MainForm implements Form {

	public function handleResponse(Player $player, $data): void {
		if(!is_bool($data)) return;
		if(sqmeru::getData()->exists($player->getName())){
			$player->sendMessage("参加ありがとうございました！");
			return;
		}
		if(!$player->getInventory()->canAddItem(SpecialBook::get())){
			$player->sendMessage("アイテム欄を開けてから参加してください。");
			return;
		}
		if($data){
			$player->sendMessage("きのこの山に投票しました！！");
			sqmeru::getData()->set($player->getName(),"きのこの山");
			sqmeru::getData()->save();
			$player->getInventory()->addItem(SpecialBook::get());
			return;
		}
		$player->sendForm(new TakenokoForm());
		return;
	}

	public function jsonSerialize() {
		return [
			'type' => 'modal',
			'title' => "§a§l総選挙！",
			'content' => "あなたはどっち派！？\n現在: きのこの山 100％\nたけのこの里 0％",
			'button1' => "きのこの山",
			'button2' => "たけのこの里",
			'button3' => "トッポ"
		];
	}
}

class TakenokoForm implements Form {

	/**
	 * @var int
	 */
	private $count;

	public function __construct(int $count=1) {
		$this->count=$count;
	}

	public function handleResponse(Player $player, $data): void {
		if(!is_bool($data)){
			$player->sendForm(new self($this->count));
			return;
		}
		if($data){
			$player->sendMessage("きのこの山に投票しました！！");
			sqmeru::getData()->set($player->getName(),"きのこの山");
			sqmeru::getData()->save();
			$player->getInventory()->addItem(SpecialBook::get());
			return;
		}
		if($this->count<3){
			$count=$this->count+1;
			$player->sendForm(new self($count));
			return;
		}
		$player->sendForm(new ReversalForm());
	}

	public function jsonSerialize() {
		return [
			'type' => 'modal',
			'title' => "§a§l総選挙！",
			'content' => "本当にそっちでいいの？！？",
			'button1' => "きのこの山",
			'button2' => "たけのこの里",
			'button3' => "トッポ"
		];
	}
}

class ReversalForm implements Form {

	public function handleResponse(Player $player, $data): void {
		if(!is_bool($data)){
			$player->sendForm(new self());
			return;
		}
		if(!$data){
			$player->sendMessage("きのこの山に投票しました！");
			sqmeru::getData()->set($player->getName(),"きのこの山");
			sqmeru::getData()->save();
			$player->getInventory()->addItem(SpecialBook::get());
			return;
		}

		$player->sendForm(new KinokoForm());
	}


	public function jsonSerialize() {
		return [
			'type' => 'modal',
			'title' => "§a§l総選挙！",
			'content' => "本当にそっちでいいの？！？",
			'button1' => "たけのこの里",
			'button2' => "きのこの山",
			'button3' => "トッポ"
		];
	}
}

class KinokoForm implements Form {

	public function handleResponse(Player $player, $data): void {
		if(!is_bool($data)){
			$player->sendForm(new self());
			return;
		}
		$player->sendMessage("きのこの山に投票しました！！");
		sqmeru::getData()->set($player->getName(),"きのこの山");
		sqmeru::getData()->save();
		$player->getInventory()->addItem(SpecialBook::get());
		return;
	}

	public function jsonSerialize() {
		return [
			'type' => 'modal',
			'title' => "§a§l総選挙！",
			'content' => "いい加減にしてよ",
			'button1' => "きのこの山",
			'button2' => "きのこの山",
			'button3' => "きのこの山"
		];
	}
}
