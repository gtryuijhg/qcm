<?php

require_once 'CharactersInfosValidator.php';

class CharactersInfosValidatorImpl implements CharactersInfosValidator
{
	public function checkNumberInClass($class):string
	{
		if (preg_match('#[0-9]#', $class)) {
			throw new InvalidParameterException('Your class cannot contain a number !');
		} else {
			return $class;
		}
	}

	public function checkSpecialCharacterInClass($class):string
	{
		if (preg_match('#[^A-Za-z0-9]#', $class)) {
			throw new InvalidParameterException('Your class cannot contain a special character !');
		} else {
			return $class;
		}
	}

	public function checkNumberInParticularity($particularity):string
	{
		if (preg_match('#[0-9]#', $particularity)) {
			throw new InvalidParameterException('Your particularity cannot contain a number !');
		} else {
			return $particularity;
		}
	}

	public function isCharacterInfosExists($characterInBase, $characterName):string
	{
		if (strtolower($characterName) === strtolower($characterInBase['character_name'])) {
			throw new UserException('This character has already infos !');
		} else {
			return $characterName;
		}
	}
}