<?php

require_once 'MobsValidator.php';

class MobsValidatorImpl implements MobsValidator
{
	public function isMobNameValid($mobName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $mobName)) {
			throw new InvalidParameterException('Mob name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $mobName)) {
			throw new InvalidParameterException('Mob name cannot contain a number !');
		} else {
			return $mobName;
		}
	}

	public function isNewMobNameValid($newMobName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $newMobName)) {
			throw new InvalidParameterException('Mob name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $newMobName)) {
			throw new InvalidParameterException('Mob name cannot contain a number !');
		} else {
			return $newMobName;
		}
	}

	public function isMobHealthValid($health):int
	{
		if ($health > 0) {
			return $health;
		} else {
			throw new InvalidParameterException('Mob health cannot be negative or null !');
		}
	}

	public function isMobLevelValid($level):int
	{
		if ($level > 0) {
			return $level;
		} else {
			throw new InvalidParameterException('Mob level cannot be negative or null !');
		}
	}
	

	public function isMobLocationValid($location):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $location)) {
			throw new InvalidParameterException('Mob location cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $location)) {
			throw new InvalidParameterException('Mob location cannot contain a number !');
		} else {
			return $location;
		}
	}
}