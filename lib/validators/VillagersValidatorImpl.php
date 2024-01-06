<?php

require_once 'VillagersValidator.php';

class VillagersValidatorImpl implements VillagersValidator
{
	public function isVillagerNameValid($villagerName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $villagerName)) {
			throw new InvalidParameterException('Villager name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $villagerName)) {
			throw new InvalidParameterException('Villager name cannot contain a number !');
		} else {
			return $villagerName;
		}
	}

	public function isNewVillagerNameValid($newVillagerName):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $newVillagerName)) {
			throw new InvalidParameterException('Villager name cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $newVillagerName)) {
			throw new InvalidParameterException('Villager name cannot contain a number !');
		} else {
			return $newVillagerName;
		}
	}

	public function isVillagerJobValid($villagerJob):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $villagerJob)) {
			throw new InvalidParameterException('Villager job cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $villagerJob)) {
			throw new InvalidParameterException('Villager job cannot contain a number !');
		} else {
			return $villagerJob;
		}
	}

	public function isVillagerVillageValid($villagerVillage):string
	{
		if (preg_match('#[^A-Za-z0-9\s]#', $villagerVillage)) {
			throw new InvalidParameterException('Villager village cannot contain a special character !');
		} else if (preg_match('#[0-9]#', $villagerVillage)) {
			throw new InvalidParameterException('Villager village cannot contain a number !');
		} else {
			return $villagerVillage;
		}
	}
}