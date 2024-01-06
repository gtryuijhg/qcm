<?php

require_once 'UsersManager.php';

class UsersManagerImpl implements UsersManager
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

	public function listUsers()
	{
		$preparedQuery = $this->_database->prepare('
						   						   SELECT user_name
						   						   FROM users
						   						   ');
		$preparedQuery->execute();
		$nameListToCheck = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $nameListToCheck;
	}

	public function addUser($id, $name, $hashLogin, $hashPassword, $status)
	{
		$newUser = $this->_database->prepare('
											 INSERT INTO users (id, user_name, user_login, user_password, user_status)
											 VALUES (:id, :user_name, :user_login, :user_password, :user_status)
											 ');
		$newUser->bindValue(':id', $id, PDO::PARAM_INT);
		$newUser->bindValue(':user_name', $name, PDO::PARAM_STR);
		$newUser->bindValue(':user_login', $hashLogin, PDO::PARAM_STR);
		$newUser->bindValue(':user_password', $hashPassword, PDO::PARAM_STR);
		$newUser->bindValue(':user_status', $status, PDO::PARAM_STR);
		$newUser->execute();
		$newUser->CloseCursor();

		return $newUser;
	}

	public function getUserStatus($name)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT user_status
												   FROM users
												   WHERE user_name = :user_name
												   ');
		$preparedQuery->bindValue(':user_name', $name, PDO::PARAM_STR);
		$preparedQuery->execute();
		$statusInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		$userStatus = htmlspecialchars($statusInBase['user_status']);

		return $userStatus;
	}

	public function switchStatusAsUser($name, $status)
	{
		$status = 'user';
		$userStatus = $this->_database->prepare('
												UPDATE users
												SET user_status = :user_status
												WHERE user_name = :user_name
												');
		$userStatus->bindValue(':user_name', $name, PDO::PARAM_STR);
		$userStatus->bindValue(':user_status', $status, PDO::PARAM_STR);
		$userStatus->execute();
		$userStatus->CloseCursor();

		return $userStatus;
	}

	public function switchStatusAsMaster($name, $status)
	{
		$status = 'master';
		$userStatus = $this->_database->prepare('
												UPDATE users
												SET user_status = :user_status
												WHERE user_name = :user_name
									   			');
		$userStatus->bindValue(':user_name', $name, PDO::PARAM_STR);
		$userStatus->bindValue(':user_status', $status, PDO::PARAM_STR);
		$userStatus->execute();
		$userStatus->CloseCursor();

		return $userStatus;
	}

	public function switchStatusAsPlayer($name, $status)
	{
		$status = 'player';
		$userStatus = $this->_database->prepare('
												UPDATE users
												SET user_status = :user_status
												WHERE user_name = :user_name
												');
		$userStatus->bindValue(':user_name', $name, PDO::PARAM_STR);
		$userStatus->bindValue(':user_status', $status, PDO::PARAM_STR);
		$userStatus->execute();
		$userStatus->CloseCursor();

		return $userStatus;
	}

	public function userConnection($login, $password)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT user_name, user_login, user_password, user_status
											 	   FROM users
												   WHERE user_login = :user_login AND user_password = :user_password
												   ');
		$preparedQuery->bindValue(':user_login', $login, PDO::PARAM_STR);
		$preparedQuery->bindValue(':user_password', $password, PDO::PARAM_STR);
		$preparedQuery->execute();
		$connectUser = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $connectUser;
	}

	public function searchUserAndPassword($userName, $password)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT user_name, user_password
												   FROM users
												   WHERE user_name = :user_name AND user_password = :user_password
												   ');
		$preparedQuery->bindValue(':user_name', $userName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':user_password', $password, PDO::PARAM_STR);
		$preparedQuery->execute();
		$searchUser = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $searchUser;
	}

	public function searchUserInBase($name)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT user_name
												   FROM users
												   WHERE user_name = :user_name
												   ');
		$preparedQuery->bindValue(':user_name', $name, PDO::PARAM_STR);
		$preparedQuery->execute();
		$userInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $userInBase;
	}

	public function searchLoginInBase($hashLogin)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT user_login
												   FROM users
												   WHERE user_login = :user_login
												   ');
		$preparedQuery->bindValue(':user_login', $hashLogin, PDO::PARAM_STR);
		$preparedQuery->execute();
		$loginInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $loginInBase;
	}
}