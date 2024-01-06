<?php

Interface CharactersStatsValidator
{
	public function isCharacterHealthValid($health):int;

	public function isCharacterEnergyValid($energy):int;

	public function isCharacterHasStats($characterName, $characterInBase):string;

	public function isStatsValid($addHealth, $addEnergy):int;

	public function isLevelMax($level):int;

	public function isPointsNumberValid($pointsNumber):int;

	public function increaseHealth($health, $maxHealth, $pointsNumber):int;

	public function reduceHealth($health, $pointsNumber):int;

	public function increaseEnergy($energy, $maxEnergy, $pointsNumber):int;

	public function reduceEnergy($energy, $pointsNumber):int;
}