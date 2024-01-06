<?php

require_once 'DungeonsValidator.php';

class DungeonsValidatorImpl implements DungeonsValidator
{
	public function isDungeonNameValid($dungeonName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $dungeonName)) {
			throw new InvalidParameterException('Dungeon name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $dungeonName)) {
			throw new InvalidParameterException('Dungeon name cannot contain a number !');
		} else {
			return $dungeonName;
		}
	}

	public function isNewDungeonNameValid($newDungeonName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $newDungeonName)) {
			throw new InvalidParameterException('Dungeon name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $newDungeonName)) {
			throw new InvalidParameterException('Dungeon name cannot contain a number !');
		} else {
			return $newDungeonName;
		}
	}

	public function isDungeonLevelValid($level):int
	{
		if ($level > 0) {
			return $level;
		} else {
			throw new InvalidParameterException('Dungeon level cannot be negative or null !');
		}
	}
}