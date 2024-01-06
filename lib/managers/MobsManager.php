<?php

interface MobsManager
{
	public function addMob($id, $mobName, $health, $level, $location, $gameName);

	public function getMobsList($gameName);

	public function updateMob($mobName, $newMobName, $health, $level, $location, $gameName);

	public function deleteMob($gameName, $mobName);
}