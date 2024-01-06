<?php

interface CharactersStuffManager
{
	public function getCharacterStuff($characterName);

	public function addStuff($id, $characterName, $armor, $weapon, $backpackSlots);

	public function getCharacterPostArmor($armor, $characterName);

	public function getCharacterArmor($characterName);

	public function updateArmor($armor, $characterName);

	public function getCharacterPostWeapon($weapon, $characterName);

	public function getCharacterWeapon($characterName);

	public function updateWeapon($weapon, $characterName);

	public function getCharacterPostBackpack($backpackSlots, $characterName);

	public function getCharacterBackpack($characterName);

	public function updateBackpack($backpackSlots, $characterName);

	public function getAllCharacterStuff($characterName);

	public function addItemToBackpack($id, $characterName, $itemName, $itemSlots);

	public function getAllCharacterBackpack($characterName);

	public function updateItem($characterName, $itemName, $newItemName, $itemSlots);

	public function deleteItem($characterName, $itemName);
}