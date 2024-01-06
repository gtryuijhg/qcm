<?php

require_once 'MastersValidator.php';

class MastersValidatorImpl implements MastersValidator
{
	public function isMasterAlreadyTaken($masterName, $masterInBase):string
	{
		if (strtolower($masterName) === strtolower($masterInBase['master_name'])) {
			throw new UserException('This master name is already taken !');
		} else {
			return $masterName;
		}
	}

	public function isMasterNameValid($masterName):string
	{
		if (strlen($masterName) > 20) {
			throw new InvalidParameterException('Your master name is too long !');
		} else if (preg_match('#[0-9]#', $masterName)) {
			throw new InvalidParameterException('Your master name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9]#', $masterName)) {
			throw new InvalidParameterException('Your master name cannot contain a special character !');
		} else {
			return $masterName;
		}
	}
}