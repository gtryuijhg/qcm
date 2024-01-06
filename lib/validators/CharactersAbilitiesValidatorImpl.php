<?php

require_once 'CharactersAbilitiesValidator.php';

class CharactersAbilitiesValidatorImpl implements CharactersAbilitiesValidator
{
	public function isPhysicsValid($physics):int
	{
		if ($physics <= 0) {
			throw new UserException('Physics value cannot be negative or null !');
		} else if ($physics > 100) {
			throw new UserException('Physics value cannot be higher than 100 !');
		} else {
			return $physics;
		}
	}

	public function isSocialValid($social):int
	{
		if ($social <= 0) {
			throw new UserException('Social value cannot be negative or null !');
		} else if ($social > 100) {
			throw new UserException('Social value cannot be higher than 100 !');
		} else {
			return $social;
		}
	}

	public function isMentalValid($mental):int
	{
		if ($mental <= 0) {
			throw new UserException('Mental value cannot be negative or null !');
		} else if ($mental > 100) {
			throw new UserException('Mental value cannot be higher than 100 !');
		} else {
			return $mental;
		}
	}

	public function isPhysicsAbilityValid($physicsAbility):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $physicsAbility)) {
			throw new InvalidParameterException('Physics ability cannot contain a special character !');
		} else {
			return $physicsAbility;
		}
	}

	public function isSocialAbilityValid($socialAbility):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $socialAbility)) {
			throw new InvalidParameterException('Physics ability cannot contain a special character !');
		} else {
			return $socialAbility;
		}
	}

	public function isMentalAbilityValid($mentalAbility):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $mentalAbility)) {
			throw new InvalidParameterException('Physics ability cannot contain a special character !');
		} else {
			return $mentalAbility;
		}
	}

	public function isCharacterHasAbilities($characterInBase, $characterName):string
	{
		if (strtolower($characterInBase['character_name']) === $characterName) {
			throw new UserException('This character has aldready abilities !');
		} else {
			return $characterName;
		}
	}
}