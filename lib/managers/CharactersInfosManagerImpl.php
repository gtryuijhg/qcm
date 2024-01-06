<?php

require_once 'CharactersInfosManager.php';

class CharactersInfosManagerImpl implements CharactersInfosManager
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

	public function checkCharacterInfos($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name
												   FROM charactersinfos
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $characterInBase;
	}

	public function addInfos($id, $characterName, $class, $particularity)
	{
		$addInfos = $this->_database->prepare('
											  INSERT INTO charactersinfos (id, character_name, class, particularity)
											  VALUES (:id, :character_name, :class, :particularity)
											  ');
		$addInfos->bindValue(':id', $id, PDO::PARAM_INT);
		$addInfos->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$addInfos->bindValue(':class', $class, PDO::PARAM_STR);
		$addInfos->bindValue(':particularity', $particularity, PDO::PARAM_STR);
		$addInfos->execute();
		$addInfos->CloseCursor();
	}

	public function getAllCharacterInfos($characterName) {
		$preparedQuery = $this->_database->prepare('
												   SELECT class, particularity
												   FROM charactersinfos
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterInfos = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $characterInfos;
	}
}