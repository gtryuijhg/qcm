<?php

require_once 'BossManager.php';

class BossManagerImpl implements BossManager
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

	public function addBoss($id, $bossName, $health, $level, $location, $gameName)
	{
		$addBoss = $this->_database->prepare('
											  INSERT INTO gameboss (id, boss_name, health, level, location, game_name)
											  VALUES (:id, :boss_name, :health, :level, :location, :game_name)
											  ');
		$addBoss->bindValue(':id', $id, PDO::PARAM_INT);
		$addBoss->bindValue(':boss_name', $bossName, PDO::PARAM_STR);
		$addBoss->bindValue(':health', $health, PDO::PARAM_STR);
		$addBoss->bindValue(':level', $level, PDO::PARAM_INT);
		$addBoss->bindValue(':location', $location, PDO::PARAM_STR);
		$addBoss->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$addBoss->execute();
		$addBoss->CloseCursor();
	}

	public function getBossList($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT boss_name, health, level, location, game_name
												   FROM gameboss
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$bossList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $bossList;
	}

	public function updateBoss($bossName, $newBossName, $health, $level, $location, $gameName)
	{
		$updateBoss = $this->_database->prepare('
												UPDATE gameboss
												SET boss_name = :new_boss_name, health = :health, level = :level, location = :location
												WHERE boss_name = :boss_name AND game_name = :game_name
												');
		$updateBoss->bindValue(':boss_name', $bossName, PDO::PARAM_STR);
		$updateBoss->bindValue(':new_boss_name', $newBossName, PDO::PARAM_STR);
		$updateBoss->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$updateBoss->bindValue(':health', $health, PDO::PARAM_INT);
		$updateBoss->bindValue(':level', $level, PDO::PARAM_INT);
		$updateBoss->bindValue(':location', $location, PDO::PARAM_STR);
		$updateBoss->execute();
		$updateBoss->CloseCursor();
	}

	public function deleteBoss($gameName, $bossName)
	{
		$preparedQuery = $this->_database->prepare('
												   DELETE FROM gameboss
												   WHERE game_name = :game_name AND boss_name = :boss_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':boss_name', $bossName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}