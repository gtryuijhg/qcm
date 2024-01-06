<?php

require_once 'VillagesValidator.php';

class VillagesValidatorImpl implements VillagesValidator
{
	public function isVillageNameValid($villageName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $villageName)) {
			throw new InvalidParameterException('Village name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $villageName)) {
			throw new InvalidParameterException('Village name cannot contain a number !');
		} else {
			return $villageName;
		}
	}

	public function isNewVillageNameValid($newVillageName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $newVillageName)) {
			throw new InvalidParameterException('Village name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $newVillageName)) {
			throw new InvalidParameterException('Village name cannot contain a number !');
		} else {
			return $newVillageName;
		}
	}
}