<?php

require_once 'CharactersStuffManager.php';

class CharactersStuffManagerImpl implements CharactersStuffManager
{
	private $_database;

	public function __construct($database)
	{
		$this->setDatabase($database);
	}

	public function setDatabase(PDO $database)
	{
		$this->_database = $database;
	}

	public function getCharacterStuff($characterName)
	{
		$preparedQuery = $this->_database->prepare('
													SELECT character_name
													FROM charactersstuff
													WHERE character_name = :character_name
													');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$stuffInBase = $preparedQuery->fetch();		
		$preparedQuery->CloseCursor();

		return $stuffInBase;
	}

	public function addStuff($id, $characterName, $armor, $weapon, $backpackSlots)
	{
		$preparedQuery = $this->_database->prepare('
												   INSERT INTO charactersstuff (id, character_name, weapon, armor, backpack_slots)
												   VALUES (:id, :character_name, :weapon, :armor, :backpack_slots)
												   ');
		$preparedQuery->bindValue(':id', $id, PDO::PARAM_INT);
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':armor', $armor, PDO::PARAM_STR);
		$preparedQuery->bindValue(':weapon', $weapon, PDO::PARAM_STR);
		$preparedQuery->bindValue(':backpack_slots', $backpackSlots, PDO::PARAM_INT);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function getCharacterPostArmor($armor, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT armor, character_name
												   FROM charactersstuff
												   WHERE character_name = :character_name AND armor = :armor
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':armor', $armor, PDO::PARAM_STR);
		$preparedQuery->execute();
		$armorInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $armorInBase;
	}

	public function getCharacterArmor($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT armor, character_name
												   FROM charactersstuff
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$armorInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $armorInBase;
	}

	public function updateArmor($armor, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   UPDATE charactersstuff
												   SET armor = :armor
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':armor', $armor, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function getCharacterPostWeapon($weapon, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT weapon, character_name
												   FROM charactersstuff
												   WHERE character_name = :character_name AND weapon = :weapon
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':weapon', $weapon, PDO::PARAM_STR);
		$preparedQuery->execute();
		$weaponInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $weaponInBase;
	}

	public function getCharacterWeapon($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT weapon, character_name
												   FROM charactersstuff
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$weaponInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $weaponInBase;
	}

	public function updateWeapon($weapon, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   UPDATE charactersstuff
												   SET weapon = :weapon
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':weapon', $weapon, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function getCharacterPostBackpack($backpackSlots, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT backpack_slots, character_name
												   FROM charactersstuff
												   WHERE character_name = :character_name AND backpack_slots = :backpack_slots
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':backpack_slots', $backpackSlots, PDO::PARAM_INT);
		$preparedQuery->execute();
		$backpackInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $backpackInBase;
	}

	public function getCharacterBackpack($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT backpack_slots, character_name
												   FROM charactersstuff
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$backpackInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $backpackInBase;
	}

	public function updateBackpack($backpackSlots, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   UPDATE charactersstuff
												   SET backpack_slots = :backpack_slots
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':backpack_slots', $backpackSlots, PDO::PARAM_INT);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function getAllCharacterStuff($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT weapon, armor, backpack_slots
												   FROM charactersstuff
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterStuff = $preparedQuery->fetchAll();		
		$preparedQuery->CloseCursor();

		return $characterStuff;
	}

	public function addItemToBackpack($id, $characterName, $itemName, $itemSlots)
	{
		$preparedQuery = $this->_database->prepare('
												   INSERT INTO charactersbackpack (id, character_name, item_name, item_slots)
												   VALUES (:id, :character_name, :item_name, :item_slots)
												   ');
		$preparedQuery->bindValue(':id', $id, PDO::PARAM_INT);
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':item_name', $itemName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':item_slots', $itemSlots, PDO::PARAM_INT);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function getAllCharacterBackpack($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT item_name, item_slots
												   FROM charactersbackpack
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterBackpack = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $characterBackpack;
	}

	public function updateItem($characterName, $itemName, $newItemName, $itemSlots)
	{
		$preparedQuery = $this->_database->prepare('
												   UPDATE charactersbackpack
												   SET item_name = :item_name, item_slots = :item_slots
												   WHERE character_name = :character_name AND item_name = :old_item_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':item_name', $newItemName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':old_item_name', $itemName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':item_slots', $itemSlots, PDO::PARAM_INT);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function deleteItem($characterName, $itemName)
	{
		$preparedQuery = $this->_database->prepare('
												   DELETE FROM charactersbackpack
												   WHERE character_name = :character_name AND item_name = :item_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':item_name', $itemName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}