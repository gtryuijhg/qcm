<?php

require_once 'CharactersSkillsManager.php';

class CharactersSkillsManagerImpl implements CharactersSkillsManager
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

	public function addSkill($id, $characterName, $skillName, $skillDescription)
	{
		$preparedQuery = $this->_database->prepare('
												   INSERT INTO charactersskills (id, character_name, skill_name, skill_description)
												   VALUES (:id, :character_name, :skill_name, :skill_description)
												   ');
		$preparedQuery->bindValue(':id', $id, PDO::PARAM_INT);
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':skill_name', $skillName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':skill_description', $skillDescription, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function getAllCharacterSkills($characterName) {
		$preparedQuery = $this->_database->prepare('
												   SELECT skill_name, skill_description
												   FROM charactersskills
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterSkills = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $characterSkills;
	}
}