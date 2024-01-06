<?php

interface BossValidator
{
	public function isBossNameValid($bossName):string;

	public function isNewBossNameValid($newBossName):string;

	public function isBossHealthValid($health):int;

	public function isBossLevelValid($level):int;

	public function isBossLocationValid($location):string;
}