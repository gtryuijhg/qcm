<?php

require_once 'KeysValidator.php';

class KeysValidatorImpl implements KeysValidator
{
	public function isKeyNameValid($keyName):string
	{
		if (preg_match('#[0-9]#', $keyName)) {
			throw new InvalidParameterException('Key name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9\s]#', $keyName)) {
			throw new InvalidParameterException('Key name cannot contain a special character !');
		} else {
			return $keyName;
		}
	}

	public function isNewKeyNameValid($newKeyName):string
	{
		if (preg_match('#[0-9]#', $newKeyName)) {
			throw new InvalidParameterException('Key name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9\s]#', $newKeyName)) {
			throw new InvalidParameterException('Key name cannot contain a special character !');
		} else {
			return $newKeyName;
		}
	}
}