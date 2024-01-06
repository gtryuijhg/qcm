<?php

require_once 'MastersManager.php';

class MastersManagerImpl implements MastersManager
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

	public function addMaster($id, $masterName, $userName)
	{
		$newMaster = $this->_database->prepare('
											   INSERT INTO masters (id, master_name, user_name)
											   VALUES (:id, :master_name, :user_name)
											   ');
		$newMaster->bindValue(':id', $id, PDO::PARAM_INT);
		$newMaster->bindValue(':master_name', $masterName, PDO::PARAM_STR);
		$newMaster->bindValue(':user_name', $userName, PDO::PARAM_STR);
		$newMaster->execute();
		$newMaster->CloseCursor();

		return $newMaster;
	}

	public function checkMasterInBase($masterName, $userName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT master_name, user_name
							 					   FROM masters
												   WHERE master_name = :master_name AND user_name = :user_name
												   ');
		$preparedQuery->bindValue(':master_name', $masterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':user_name', $userName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$useMaster = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $useMaster;
	}

	public function searchMasterInBase($masterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT master_name
												   FROM masters
												   WHERE master_name = :master_name
												   ');
		$preparedQuery->bindValue(':master_name', $masterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$masterInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $masterInBase;
	}
}