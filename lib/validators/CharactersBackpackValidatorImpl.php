<?php

require_once 'CharactersBackpackValidator.php';

class CharactersBackpackValidatorImpl implements CharactersBackpackValidator
{
	public function isItemSlotsValid($itemSlots):int
	{
		if ($itemSlots > 0) {
			return $itemSlots;
		} else {
			throw new InvalidParameterException('An item slot cannot be negative or null !');
		}
	}
}