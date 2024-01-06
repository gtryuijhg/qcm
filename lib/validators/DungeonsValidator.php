<?php

interface DungeonsValidator
{
	public function isDungeonNameValid($dungeonName):string;

	public function isNewDungeonNameValid($newDungeonName):string;

	public function isDungeonLevelValid($level):int;
}