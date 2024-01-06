<?php

require_once 'CharactersStuffValidator.php';

class CharactersStuffValidatorImpl implements CharactersStuffValidator
{
	public function isArmorValid($armor):string
	{
		if (preg_match('#[0-9]#', $armor)) {
			throw new InvalidParameterException('An armor name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9\s]#', $armor)) {
			throw new InvalidParameterException('An armor name cannot contain a special character !');
		} else {
			return $armor;
		}
	}

	public function isWeaponValid($weapon):string
	{
		if (preg_match('#[0-9]#', $weapon)) {
			throw new InvalidParameterException('A weapon name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9\s]#', $weapon)) {
			throw new InvalidParameterException('A weapon name cannot contain a special character !');
		} else {
			return $weapon;
		}
	}

	public function isBackpackValid($backpackSlots):int
	{
		if ($backpackSlots < 1) {
			throw new InvalidParameterException('A backpack cannot have zero slots !');
		} else {
			return $backpackSlots;
		}
	}

	public function isCharacterHasStuff($characterName, $stuffInBase):string
	{
		if (strtolower($characterName) === strtolower($stuffInBase['character_name'])) {
			throw new UserException('Character has already stuff !');
		} else {
			return $characterName;
		}
	}

	public function isSameWeapon($weaponInBase, $weapon):string
	{
		if (strtolower($weapon) === strtolower($weaponInBase['weapon'])) {
			throw new UserException('This is the same weapon !');
		} else {
			return $weapon;
		}
	}

	public function isSameArmor($armorInBase, $armor):string
	{
		if (strtolower($armor) === strtolower($armorInBase['armor'])) {
			throw new UserException('This is the same armor !');
		} else {
			return $armor;
		}
	}

	public function isSameBackpack($backpackInBase, $backpackSlots):string
	{
		if (strtolower($backpackSlots) === strtolower($backpackInBase['backpack_slots'])) {
			throw new UserException('This is the same backpack !');
		} else {
			return $backpackSlots;
		}
	}

	public function isItemSlotsValid($itemSlots):int
	{
		if ($itemSlots < 1) {
			throw new InvalidParameterException('An item cannot have zero slots !');
		} else {
			return $itemSlots;
		}
	}
}