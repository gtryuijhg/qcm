<?php

require_once 'MobsManager.php';

class MobsManagerImpl implements MobsManager
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

	public function addMob($id, $mobName, $health, $level, $location, $gameName)
	{
		$addMob = $this->_database->prepare('
											  INSERT INTO gamemobs (id, mob_name, health, level, location, game_name)
											  VALUES (:id, :mob_name, :health, :level, :location, :game_name)
											  ');
		$addMob->bindValue(':id', $id, PDO::PARAM_INT);
		$addMob->bindValue(':mob_name', $mobName, PDO::PARAM_STR);
		$addMob->bindValue(':health', $health, PDO::PARAM_STR);
		$addMob->bindValue(':level', $level, PDO::PARAM_INT);
		$addMob->bindValue(':location', $location, PDO::PARAM_STR);
		$addMob->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$addMob->execute();
		$addMob->CloseCursor();
	}

	public function getMobsList($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT mob_name, health, level, location, game_name
												   FROM gamemobs
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$mobsList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $mobsList;
	}

	public function updateMob($mobName, $newMobName, $health, $level, $location, $gameName)
	{
		$updateMob = $this->_database->prepare('
											   UPDATE gamemobs
											   SET mob_name = :new_mob_name, health = :health, level = :level, location = :location
											   WHERE mob_name = :mob_name AND game_name = :game_name
											   ');
		$addMob->bindValue(':mob_name', $mobName, PDO::PARAM_STR);
		$addMob->bindValue(':new_mob_name', $newMobName, PDO::PARAM_STR);
		$addMob->bindValue(':health', $health, PDO::PARAM_STR);
		$addMob->bindValue(':level', $level, PDO::PARAM_INT);
		$addMob->bindValue(':location', $location, PDO::PARAM_STR);
		$addMob->bindValue(':game_name', $game, PDO::PARAM_STR);
		$addMob->execute();
		$addMob->CloseCursor();
	}

	public function deleteMob($gameName, $mobName)
	{
		$preparedQuery = $this->_database->prepare('
												   DELETE FROM gamemobs
												   WHERE game_name = :game_name AND mob_name = :mob_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':mob_name', $mobName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}