<?php

interface VillagesValidator
{
	public function isVillageNameValid($villageName):string;

	public function isNewVillageNameValid($newVillageName):string;
}