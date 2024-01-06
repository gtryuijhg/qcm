<?php

require_once 'PlayersManager.php';

class PlayersManagerImpl implements PlayersManager
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
	
	public function getPlayerInBase($playerName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT player_name
												   FROM players
												   WHERE player_name = :player_name
												   ');
		$preparedQuery->bindValue(':player_name', $playerName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$playerInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $playerInBase;
	}

	public function addPlayer($id, $playerName, $gameName, $userName)
	{
		$newPlayer = $this->_database->prepare('
											   INSERT INTO players (id, player_name, game_name, user_name)
											   VALUES (:id, :player_name, :game_name, :user_name)
											   ');
		$newPlayer->bindValue(':id', $id, PDO::PARAM_INT);
		$newPlayer->bindValue(':player_name', $playerName, PDO::PARAM_STR);
		$newPlayer->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$newPlayer->bindValue(':user_name', $userName, PDO::PARAM_STR);
		$newPlayer->execute();
		$newPlayer->CloseCursor();

		return $newPlayer;
	}

	public function takeGameInBase($playerName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT game_name
												   FROM players
												   WHERE player_name = :player_name
												   ');
		$preparedQuery->bindValue(':player_name', $playerName);
		$preparedQuery->execute();
		$gameName = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();
		
		return $gameName;
	}

	public function takePlayerInBase($playerName, $gameName, $userName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT player_name, game_name, user_name
							 					   FROM players
												   WHERE player_name = :player_name AND game_name = :game_name AND user_name = :user_name
												   ');
		$preparedQuery->bindValue(':player_name', $playerName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':user_name', $userName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$playerInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $playerInBase;
	}

	public function getAllPlayers($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT player_name
												   FROM players
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$playersList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		foreach ($playersList as $player) {
			$playerName = $player['player_name'];
		}

		return $playerName;
	}

	public function getPlayerGame($playerName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT player_name, game_name
												   FROM players
												   WHERE player_name = :player_name
												   ');
		$preparedQuery->bindValue(':player_name', $playerName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$gameInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $gameInBase;
	}
}