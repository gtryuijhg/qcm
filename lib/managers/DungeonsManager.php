<?php

interface DungeonsManager
{
	public function addDungeon($id, $dungeonName, $level, $gameName);

	public function getDungeonsList($gameName);

	public function updateDungeon($dungeonName, $newDungeonName, $level, $gameName);

	public function deleteDungeon($gameName, $dungeonName);
}