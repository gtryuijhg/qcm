<?php

require_once 'CharactersValidator.php';

class CharactersValidatorImpl implements CharactersValidator
{
	public function checkCharacterNameLength($characterName):int
	{
		if (strlen($characterName) > 20) {
			throw new InvalidParameterException('Your character name is too long !');
		} else {
			return $characterName;
		}
	}

	public function isCharacterNameAlreadyTaken($characterName, $characterNameInBase):string
	{
		if (strtolower($characterName) === strtolower($characterNameInBase['character_name'])) {
			throw new UserProfileException('This character name is already taken !');
		} else {
			return $characterName;
		}
	}

	public function checkNumberInCharacterName($characterName):string
	{
		if (preg_match('#[0-9]#', $characterName)) {
			throw new InvalidParameterException('Your character name cannot contain a number !');
		} else {
			return $characterName;
		}
	}

	public function checkSpecialCharacterInCharacterName($characterName):string
	{
		if (preg_match('#[^A-Za-z0-9]#', $characterName)) {
			throw new InvalidParameterException('Your character name cannot contain a special character !');
		} else {
			return $characterName;
		}
	}

	public function isCharacterExist($characterName, $characterInBase):string
	{
		if (strtolower($characterName) === strtolower($characterInBase['character_name'])) {
			return $characterName;
		} else {
			throw new Userexception('Character not found !');
		}
	}
}