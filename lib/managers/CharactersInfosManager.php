<?php

Interface CharactersInfosManager
{
	public function checkCharacterInfos($characterName);

	public function addInfos($id, $characterName, $class, $particularity);

	public function getAllCharacterInfos($characterName);
}