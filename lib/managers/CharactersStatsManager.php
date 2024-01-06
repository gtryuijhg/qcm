<?php

Interface CharactersStatsManager
{
	public function getCharacterStats($characterName);

	public function addStats($id, $level, $health, $maxHealth, $energy, $maxEnergy, $characterName);

	public function levelUpCharacterHealth($characterName, $addHealth);

	public function levelUpCharacterMaxHealth($characterName, $addHealth);

	public function levelUpCharacterEnergy($characterName, $addEnergy);

	public function levelUpCharacterMaxEnergy($characterName, $addEnergy);

	public function getCharacterLevel($characterName);

	public function updateStats($health, $maxHealth, $energy, $maxEnergy, $level, $characterName);

	public function getCharacterHealth($health, $characterName);

	public function getCharacterEnergy($energy, $characterName);

	public function updateCharacterHealth($health, $characterName);

	public function updateCharacterEnergy($energy, $characterName);

	public function getAllCharacterStats($characterName);
}