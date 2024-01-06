<?php

require_once 'CharactersStatsValidator.php';

class CharactersStatsValidatorImpl implements CharactersStatsValidator
{
	public function isCharacterHealthValid($health):int
	{
		if ($health < 5) {
			throw new InvalidParameterException('The base health of a character cannot be lower than 5 !');
		} else if ($health > 12) {
			throw new InvalidParameterException('The base health of a character cannot be higher than 12 !');
		} else {
			return $health;
		}
	}

	public function isCharacterEnergyValid($energy):int
	{
		if ($energy < 5) {
			throw new InvalidParameterException('The base energy of a character cannot be lower than 5 !');
		} else if ($energy > 12) {
			throw new InvalidParameterException('The base energy of a character cannot be higher than 12 !');
		} else {
			return $energy;
		}
	}

	public function isCharacterHasStats($characterName, $characterInBase):string
	{
		if (strtolower($characterName) === strtolower($characterInBase['character_name'])) {
			throw new UserException('This character has already his stats !');
		} else {
			return $characterName;
		}
	}

	public function isStatsValid($addHealth, $addEnergy):int
	{
		if (($addHealth < 0) || ($addEnergy < 0)) {
			throw new InvalidParameterException('Impossible to add or remove a negative number !');
		}					
	}

	public function isLevelMax($level):int
	{
		if ($level > 10) {
			throw new UserException('Your character is level max !');
		} else {
			return $level;
		}
	}

	public function isPointsNumberValid($pointsNumber):int
	{
		if ($pointsNumber > 0) {
			return $pointsNumber;
		} else {
			throw new InvalidParameterException('Negative or null number cannot change stats !');
		}
	}

	public function increaseHealth($health, $maxHealth, $pointsNumber):int
	{
		if ($health['health'] + $pointsNumber < $maxHealth) {
			$health = $health['health'] + $pointsNumber;
			return $health;
		} else {
			$health = $maxHealth;
			return $health;
		}
	}

	public function reduceHealth($health, $pointsNumber):int
	{
		if ($health['health'] - $pointsNumber > 0) {
			$health = $health['health'] - $pointsNumber;
			return $health;
		} else {
			$health = 0;
			return $health;
		}
	}

	public function increaseEnergy($energy, $maxEnergy, $pointsNumber):int
	{
		if ($energy['energy'] + $pointsNumber < $maxEnergy) {
			$energy = $energy['energy'] + $pointsNumber;
			return $energy;
		} else {
			$energy = $maxEnergy;
			return $energy;
		}
	}

	public function reduceEnergy($energy, $pointsNumber):int
	{
		if ($energy['energy'] - $pointsNumber > 0) {
			$energy = $energy['energy'] - $pointsNumber;
			return $energy;
		} else {
			$energy = 0;
			return $energy;
		}
	}
}