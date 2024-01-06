<?php

interface MastersValidator
{
	public function isMasterAlreadyTaken($masterName, $masterInBase):string;

	public function isMasterNameValid($masterName):string;
}