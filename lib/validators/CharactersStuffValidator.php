<?php

interface CharactersStuffValidator
{
	public function isArmorValid($armor):string;

	public function isWeaponValid($weapon):string;

	public function isBackpackValid($backpackSlots):int;

	public function isCharacterHasStuff($characterName, $stuffInBase):string;

	public function isSameWeapon($weaponInBase, $weapon):string;

	public function isSameArmor($armorInBase, $armor):string;

	public function isSameBackpack($backpackInBase, $backpackSlots):string;

	public function isItemSlotsValid($itemSlots):int;
}