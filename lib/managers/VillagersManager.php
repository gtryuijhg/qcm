<?php

interface VillagersManager
{
	public function addVillager($id, $villagerName, $villagerJob, $villagerVillage, $game);

	public function getVillagersList($gameName);

	public function updateVillager($villagerName, $newVillagerName, $villagerJob, $villagerVillage, $gameName);

	public function deleteVillager($gameName, $villagerName);
}