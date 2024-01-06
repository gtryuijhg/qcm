<?php

require_once 'ScrollsManager.php';

class ScrollsManagerImpl implements ScrollsManager
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

	public function addScroll($id, $scrollName, $gameName)
	{
		$addScroll = $this->_database->prepare('
											   INSERT INTO gamescrolls (id, scroll_name, game_name)
											   VALUES (:id, :scroll_name, :game_name)
											   ');
		$addScroll->bindValue(':id', $id, PDO::PARAM_INT);
		$addScroll->bindValue(':scroll_name', $scrollName, PDO::PARAM_STR);
		$addScroll->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$addScroll->execute();
		$addScroll->CloseCursor();
	}

	public function getScrollsList($gameName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT scroll_name, game_name
												   FROM gamescrolls
												   WHERE game_name = :game_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$scrollsList = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $scrollsList;
	}

	public function updateScroll($scrollName, $newScrollName, $gameName)
	{
		$updateScroll = $this->_database->prepare('
												  UPDATE gamescrolls
												  SET scroll_name = :new_scroll_name
												  WHERE scroll_name = :scroll_name AND game_name = :game_name
												  ');
		$updateScroll->bindValue(':new_scroll_name', $newScrollName, PDO::PARAM_STR);
		$updateScroll->bindValue(':scroll_name', $scrollName, PDO::PARAM_STR);
		$updateScroll->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$updateScroll->execute();
		$updateScroll->CloseCursor();
	}

	public function deleteScroll($gameName, $scrollName)
	{
		$preparedQuery = $this->_database->prepare('
												   DELETE FROM gamescrolls
												   WHERE game_name = :game_name AND scroll_name = :scroll_name
												   ');
		$preparedQuery->bindValue(':game_name', $gameName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':scroll_name', $scrollName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}
}