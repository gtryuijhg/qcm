<?php

interface CharactersManager
{
	public function getCharacterName($characterName);

	public function addCharacter($id, $characterName, $playerName);

	public function checkCharacterNameWithPlayerInBase($characterName, $playerName);

	public function getAllGameCharactersList($playerName);

	public function getAllGameCharactersName($playerName);

	public function getCharacter($characterName);
}