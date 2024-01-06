<?php

interface CharactersInfosValidator
{
	public function checkNumberInClass($class):string;

	public function checkSpecialCharacterInClass($class):string;

	public function checkNumberInParticularity($particularity):string;

	public function isCharacterInfosExists($characterInBase, $characterName):string;
}