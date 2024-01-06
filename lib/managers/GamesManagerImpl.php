<?php

require_once 'GamesManager.php';

class GamesManagerImpl implements GamesManager
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

	public function addGame($id, $gameName, $masterName)
	{
		$preparedQuery = $this->_database->prepare('
												   INSERT INTO games (id, game_name, master_name)
												   VALUES (:id, :game_name, :master_name)
												   ');
		$preparedQuery->bindValue(':id', $id, PDO::PARAM_INT);
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':master_name', $masterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function checkGameNameWithMasterInBase($gameName, $masterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT game_name, master_name
												   FROM games
												   WHERE game_name = :game_name AND master_name = :master_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':master_name', $masterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$useGame = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $useGame;
	}

	public function getListOfGames()
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT game_name, master_name, players_number
												   FROM games
												   ');
		$preparedQuery->execute();
		$gamesList = $preparedQuery->fetchALL();
		$preparedQuery->CloseCursor();

		return $gamesList;
	}

	public function getPlayersNumberByGame($gameName, $oldPlayersNumber)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT players_number
												   FROM games
												   WHERE game_name = :game_name AND players_number = :players_number
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':players_number', $oldPlayersNumber, PDO::PARAM_INT);
		$preparedQuery->execute();
		$oldPlayersNumber = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $oldPlayersNumber;
	}

	public function getGameNameInBase($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT game_name
												   FROM games
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$gameInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $gameInBase;
	}

	public function setPlayerNumberInGame($gameName, $playersNumber)
	{
		$preparedQuery = $this->_database->prepare('
												   UPDATE games
												   SET players_number = :players_number
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':players_number', $playersNumber, PDO::PARAM_INT);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}