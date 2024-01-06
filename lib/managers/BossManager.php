<?php

interface BossManager
{
	public function addBoss($id, $bossName, $health, $level, $location, $game);

	public function getBossList($gameName);

	public function updateBoss($bossName, $newBossName, $health, $level, $location, $gameName);

	public function deleteBoss($gameName, $bossName);
}