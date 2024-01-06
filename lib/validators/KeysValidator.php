<?php

interface KeysValidator
{
	public function isKeyNameValid($keyName):string;

	public function isNewKeyNameValid($newKeyName):string;
}