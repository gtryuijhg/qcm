<?php

require_once 'CharactersManager.php';

class CharactersManagerImpl implements CharactersManager
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

	public function getCharacterName($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name
							   					   FROM characters
							    				   WHERE character_name = :character_name
							    				   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterNameInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $characterNameInBase;
	}

	public function addCharacter($id, $characterName, $playerName)
	{
		$preparedQuery = $this->_database->prepare('
												   INSERT INTO characters (id, character_name, player_name)
												   VALUES (:id, :character_name, :player_name)
												   ');
		$preparedQuery->bindValue(':id', $id, PDO::PARAM_INT);
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':player_name', $playerName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function checkCharacterNameWithPlayerInBase($characterName, $playerName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name, player_name
												   FROM characters
												   WHERE character_name = :character_name AND player_name = :player_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':player_name', $playerName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$useCharacter = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $useCharacter;
	}

	public function getAllGameCharactersList($playerName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name
												   FROM characters
												   WHERE player_name = :player_name
												   ');
		$preparedQuery->bindValue(':player_name', $playerName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$charactersList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $charactersList;
	}

	public function getAllGameCharactersName($playerName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name
												   FROM characters
												   WHERE player_name = :player_name
												   ');
		$preparedQuery->bindValue(':player_name', $playerName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$charactersList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		foreach ($charactersList as $character) {
			$characterName = $character['character_name'];

			return $characterName;
		}
	}

	public function getCharacter($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name, player_name
												   FROM characters
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$character = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $character;
	}
}