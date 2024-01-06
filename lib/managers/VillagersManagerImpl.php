<?php

require_once 'VillagersManager.php';

class VillagersManagerImpl implements VillagersManager
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

	public function addVillager($id, $villagerName, $villagerJob, $villagerVillage, $game)
	{
		$addVillager = $this->_database->prepare('
												 INSERT INTO gamevillagers (id, villager_name, villager_job, villager_village, game_name)
												 VALUES (:id, :villager_name, :villager_job, :villager_village, :game_name)
												 ');
		$addVillager->bindValue(':id', $id, PDO::PARAM_INT);
		$addVillager->bindValue(':villager_name', $villagerName, PDO::PARAM_STR);
		$addVillager->bindValue(':villager_job', $villagerJob, PDO::PARAM_STR);
		$addVillager->bindValue(':villager_village', $villagerVillage, PDO::PARAM_STR);
		$addVillager->bindValue(':game_name', $game, PDO::PARAM_STR);
		$addVillager->execute();
		$addVillager->CloseCursor();
	}

	public function getVillagersList($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT villager_name, villager_job, villager_village, game_name
												   FROM gamevillagers
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$villagersList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $villagersList;
	}

	public function updateVillager($villagerName, $newVillagerName, $villagerJob, $villagerVillage, $gameName)
	{
		$updateVillager = $this->_database->prepare('
													UPDATE gamevillagers
													SET villager_name = :new_villager_name, villager_job = :villager_job, villager_village = :villager_village
													WHERE villager_name = :villager_name AND game_name = :game_name
													');
		$updateVillager->bindValue(':villager_name', $villagerName, PDO::PARAM_STR);
		$updateVillager->bindValue(':new_villager_name', $newVillagerName, PDO::PARAM_STR);
		$updateVillager->bindValue(':villager_job', $villagerJob, PDO::PARAM_STR);
		$updateVillager->bindValue(':villager_village', $villagerVillage, PDO::PARAM_STR);
		$updateVillager->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$updateVillager->execute();
		$updateVillager->CloseCursor();
	}

	public function deleteVillager($gameName, $villagerName)
	{
		$preparedQuery = $this->_database->prepare('
												   DELETE FROM gamevillagers
												   WHERE game_name = :game_name AND villager_name = :villager_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':villager_name', $villagerName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}