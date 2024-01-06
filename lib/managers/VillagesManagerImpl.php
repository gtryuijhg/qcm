<?php

require_once 'VillagesManager.php';

class VillagesManagerImpl implements VillagesManager
{
	private $_database;

	public function __construct($database)
	{
		$this->setDatabase($database);
	}

	public function setDatabase(PDO $database)
	{
		$this->_database = $database;
	}

	public function addVillage($id, $villageName, $game)
	{
		$addVillage = $this->_database->prepare('
										 INSERT INTO gamevillages (id, village_name, game_name)
										 VALUES (:id, :village_name, :game_name)
										 ');
		$addVillage->bindValue(':id', $id, PDO::PARAM_INT);
		$addVillage->bindValue(':village_name', $villageName, PDO::PARAM_STR);
		$addVillage->bindValue(':game_name', $game, PDO::PARAM_STR);
		$addVillage->execute();
		$addVillage->CloseCursor();
	}

	public function getVillagesList($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT village_name, game_name
												   FROM gamevillages
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$villagesList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $villagesList;
	}

	public function updateVillage($villageName, $newVillageName, $gameName)
	{
		$updateVillage = $this->_database->prepare('
												   UPDATE gamevillages
												   SET village_name = :new_village_name
												   WHERE village_name = :village_name AND game_name = :game_name
												   ');
		$updateVillage->bindValue(':new_village_name', $newVillageName, PDO::PARAM_STR);
		$updateVillage->bindValue(':village_name', $villageName, PDO::PARAM_STR);
		$updateVillage->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$updateVillage->execute();
		$updateVillage->CloseCursor();
	}

	public function deleteVillage($gameName, $villageName)
	{
		$preparedQuery = $this->_database->prepare('
												   DELETE FROM gamevillages
												   WHERE game_name = :game_name AND village_name = :village_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':village_name', $villageName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}