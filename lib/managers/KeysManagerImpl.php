<?php

require_once 'KeysManager.php';

class KeysManagerImpl implements KeysManager
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

	public function addKey($id, $keyName, $gameName)
	{
		$addKey = $this->_database->prepare('
											INSERT INTO gamekeys (id, key_name, game_name)
											VALUES (:id, :key_name, :game_name)
											');
		$addKey->bindValue(':id', $id, PDO::PARAM_INT);
		$addKey->bindValue(':key_name', $keyName, PDO::PARAM_STR);
		$addKey->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$addKey->execute();
		$addKey->CloseCursor();
	}

	public function getKeysList($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT key_name, game_name
												   FROM gamekeys
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$keysList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $keysList;
	}

	public function updateKey($keyName, $newKeyName, $gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   UPDATE gamekeys
												   SET key_name = :new_key_name
												   WHERE key_name = :key_name AND game_name = :game_name
												   ');
		$preparedQuery->bindValue(':new_key_name', $newKeyName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':key_name', $keyName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function deleteKey($gameName, $keyName)
	{
		$preparedQuery = $this->_database->prepare('
												   DELETE FROM gamekeys
												   WHERE game_name = :game_name AND key_name = :key_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':key_name', $keyName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}