<?php

require_once 'CharactersStatsManager.php';

class CharactersStatsManagerImpl implements CharactersStatsManager
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

	public function getCharacterStats($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $characterInBase;
	}

	public function addStats($id, $level, $health, $maxHealth, $energy, $maxEnergy, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   INSERT INTO charactersstats (id, character_name, level, health, max_health, energy, max_energy)
												   VALUES (:id, :character_name, :level, :health, :max_health, :energy, :max_energy)
												   ');
		$preparedQuery->bindValue(':id', $id, PDO::PARAM_INT);
		$preparedQuery->bindValue(':level', $level, PDO::PARAM_INT);
		$preparedQuery->bindValue(':health', $health, PDO::PARAM_INT);
		$preparedQuery->bindValue(':max_health', $maxHealth, PDO::PARAM_INT);
		$preparedQuery->bindValue(':energy', $energy, PDO::PARAM_INT);
		$preparedQuery->bindValue(':max_energy', $maxEnergy, PDO::PARAM_INT);
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function levelUpCharacterHealth($characterName, $addHealth)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name, health
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$health = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		//we add health and health
		$health = $health['health'] + $addHealth;

		return $health;
	}

	public function levelUpCharacterMaxHealth($characterName, $addHealth)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name, max_health
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$maxHealth = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		//we add health and max health
		$maxHealth = $maxHealth['max_health'] + $addHealth;

		return $maxHealth;
	}

	public function levelUpCharacterEnergy($characterName, $addEnergy)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name, energy
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$energy = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		//we add energy and energy
		$energy = $energy['energy'] + $addEnergy;

		return $energy;
	}

	public function levelUpCharacterMaxEnergy($characterName, $addEnergy)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name, max_energy
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$maxEnergy = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		//we add energy and max energy
		$maxEnergy = $maxEnergy['max_energy'] + $addEnergy;

		return $maxEnergy;
	}

	public function getCharacterLevel($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name, level
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$level = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		//we update level
		$level = $level['level'] + 1;

		return $level;
	}

	public function updateStats($health, $maxHealth, $energy, $maxEnergy, $level, $characterName)
	{
		$newStats = $this->_database->prepare('
											  UPDATE charactersstats
											  SET level = :level, health = :health, max_health = :max_health, energy = :energy, max_energy = :max_energy
											  WHERE character_name = :character_name
											  ');
		$newStats->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$newStats->bindValue(':level', $level, PDO::PARAM_INT);
		$newStats->bindValue(':health', $health, PDO::PARAM_INT);
		$newStats->bindValue(':max_health', $maxHealth, PDO::PARAM_INT);
		$newStats->bindValue(':energy', $energy, PDO::PARAM_INT);
		$newStats->bindValue(':max_energy', $maxEnergy, PDO::PARAM_INT);
		$newStats->execute();
		$newStats->CloseCursor();
	}

	public function getCharacterHealth($health, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT health, max_health
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$health = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $health;
	}

	public function getCharacterEnergy($energy, $characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT energy, max_energy
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$energy = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $energy;
	}

	public function updateCharacterHealth($health, $characterName)
	{
		$updateCharacterHealth = $this->_database->prepare('
														   UPDATE charactersstats
														   SET health = :health
														   WHERE character_name = :character_name
														   ');
		$updateCharacterHealth->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$updateCharacterHealth->bindValue(':health', $health, PDO::PARAM_INT);
		$updateCharacterHealth->execute();
		$updateCharacterHealth->CloseCursor();
	}

	public function updateCharacterEnergy($energy, $characterName)
	{
		$updateCharacterEnergy = $this->_database->prepare('
														   UPDATE charactersstats
														   SET energy = :energy
														   WHERE character_name = :character_name
														   ');
		$updateCharacterEnergy->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$updateCharacterEnergy->bindValue(':energy', $energy, PDO::PARAM_INT);
		$updateCharacterEnergy->execute();
		$updateCharacterEnergy->CloseCursor();
	}

	public function getAllCharacterStats($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT level, health, max_health, energy, max_energy
												   FROM charactersstats
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterStats = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $characterStats;
	}
}