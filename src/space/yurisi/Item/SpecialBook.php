<?php


namespace space\yurisi\Item;


use pocketmine\item\Item;

class SpecialBook {
	public static function get(): Item {
		$item=Item::get(340,0);
		$item->setCustomName("総選挙 参加賞！ きのこの山への投票ありがとうございました！");
		$item->setLore(["初めての景品付きイベント！","きのこの山しか勝たん！参加ありがとうございました！"]);
		return $item;
	}

}
