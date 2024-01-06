<?php

interface VillagesManager
{
	public function addVillage($id, $villageName, $game);

	public function getVillagesList($gameName);

	public function updateVillage($villageName, $newVillageName, $gameName);

	public function deleteVillage($gameName, $villageName);
}