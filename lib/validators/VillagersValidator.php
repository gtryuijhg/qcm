<?php

interface VillagersValidator
{
	public function isVillagerNameValid($villagerName):string;

	public function isNewVillagerNameValid($newVillagerName):string;

	public function isVillagerJobValid($villagerJob):string;

	public function isVillagerVillageValid($villagerVillage):string;
}