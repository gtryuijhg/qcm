<?php

interface CharactersValidator
{
	public function checkCharacterNameLength($characterName):int;

	public function isCharacterNameAlreadyTaken($characterName, $characterNameInBase):string;

	public function checkNumberInCharacterName($characterName):string;

	public function checkSpecialCharacterInCharacterName($characterName):string;

	public function isCharacterExist($characterName, $characterInBase):string;
}