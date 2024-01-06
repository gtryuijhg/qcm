<?php

require_once 'DungeonsManager.php';

class DungeonsManagerImpl implements DungeonsManager
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

	public function addDungeon($id, $dungeonName, $level, $gameName)
	{
		$addDungeon = $this->_database->prepare('
												INSERT INTO gamedungeons (id, dungeon_name, level, game_name)
												VALUES (:id, :dungeon_name, :level, :game_name)
												');
		$addDungeon->bindValue(':id', $id, PDO::PARAM_INT);
		$addDungeon->bindValue(':dungeon_name', $dungeonName, PDO::PARAM_STR);
		$addDungeon->bindValue(':level', $level, PDO::PARAM_STR);
		$addDungeon->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$addDungeon->execute();
		$addDungeon->CloseCursor();
	}

	public function getDungeonsList($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT dungeon_name, level, game_name
												   FROM gamedungeons
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$dungeonsList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $dungeonsList;
	}

	public function updateDungeon($dungeonName, $newDungeonName, $level, $gameName)
	{
		$updateDungeon = $this->_database->prepare('
												   UPDATE gamedungeons
												   SET dungeon_name = :new_dungeon_name, level = :level
												   WHERE dungeon_name = :dungeon_name AND game_name = :game_name
												   ');
		$updateDungeon->bindValue(':dungeon_name', $dungeonName, PDO::PARAM_STR);
		$updateDungeon->bindValue(':new_dungeon_name', $newDungeonName, PDO::PARAM_STR);
		$updateDungeon->bindValue(':level', $level, PDO::PARAM_STR);
		$updateDungeon->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$updateDungeon->execute();
		$updateDungeon->CloseCursor();
	}

	public function deleteDungeon($gameName, $dungeonName)
	{
		$preparedQuery = $this->_database->prepare('
												   DELETE FROM gamedungeons
												   WHERE game_name = :game_name AND dungeon_name = :dungeon_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':dungeon_name', $dungeonName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}