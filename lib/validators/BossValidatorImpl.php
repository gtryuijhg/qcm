<?php

require_once 'BossValidator.php';

class BossValidatorImpl implements BossValidator
{
	public function isBossNameValid($bossName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $bossName)) {
			throw new InvalidParameterException('Boss name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $bossName)) {
			throw new InvalidParameterException('Boss name cannot contain a number !');
		} else {
			return $bossName;
		}
	}

	public function isNewBossNameValid($newBossName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $newBossName)) {
			throw new InvalidParameterException('Boss name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $newBossName)) {
			throw new InvalidParameterException('Boss name cannot contain a number !');
		} else {
			return $newBossName;
		}
	}

	public function isBossHealthValid($health):int
	{
		if ($health > 0) {
			return $health;
		} else {
			throw new InvalidParameterException('Boss health cannot be negative or null !');
		}
	}

	public function isBossLevelValid($level):int
	{
		if ($level > 0) {
			return $level;
		} else {
			throw new InvalidParameterException('Boss level cannot be negative or null !');
		}
	}
	

	public function isBossLocationValid($location):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $location)) {
			throw new InvalidParameterException('Boss location cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $location)) {
			throw new InvalidParameterException('Boss location cannot contain a number !');
		} else {
			return $location;
		}
	}
}