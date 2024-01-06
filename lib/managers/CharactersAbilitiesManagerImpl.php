<?php

require_once 'CharactersAbilitiesManager.php';

class CharactersAbilitiesManagerImpl implements CharactersAbilitiesManager
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

	public function getCharacterAbilities($characterName)
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT character_name
												   FROM charactersabilities
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterInBase = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		return $characterInBase;
	}

	public function addAbilities($id, $characterName, $physics, $physicsAbility, $social, $socialAbility, $mental, $mentalAbility)
	{
		$preparedQuery = $this->_database->prepare('
												   INSERT INTO charactersabilities (id, character_name, physics, social, mental, physics_ability, social_ability, mental_ability)
								    			   VALUES (:id, :character_name, :physics, :social, :mental, :physics_ability, :social_ability, :mental_ability)
								    			   ');
		$preparedQuery->bindValue(':id', $id, PDO::PARAM_STR);
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->bindValue(':physics', $physics, PDO::PARAM_INT);
		$preparedQuery->bindValue(':physics_ability', $physicsAbility, PDO::PARAM_STR);
		$preparedQuery->bindValue(':social', $social, PDO::PARAM_INT);
		$preparedQuery->bindValue(':social_ability', $socialAbility, PDO::PARAM_STR);
		$preparedQuery->bindValue(':mental', $mental, PDO::PARAM_INT);
		$preparedQuery->bindValue(':mental_ability', $mentalAbility, PDO::PARAM_STR);
		$preparedQuery->execute();
		$preparedQuery->CloseCursor();
	}

	public function getCharacterPhysics($characterName) 
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT physics, character_name
												   FROM charactersabilities
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$physics = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		//we update physics
		$physics = $physics['physics'] + 5;

		return $physics;
	}

	public function getCharacterSocial($characterName) 
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT social, character_name
												   FROM charactersabilities
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$social = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		//we update social
		$social = $social['social'] + 5;

		return $social;
	}

	public function getCharacterMental($characterName) 
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT mental, character_name
												   FROM charactersabilities
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$mental = $preparedQuery->fetch();
		$preparedQuery->CloseCursor();

		//we update mental
		$mental = $mental['mental'] + 5;

		return $mental;
	}

	public function updateAbilities($physics, $social, $mental, $characterName) 
	{
		$newAbilities = $this->_database->prepare('
												  UPDATE charactersabilities
												  SET physics = :physics, social = :social, mental = :mental
												  WHERE character_name = :character_name
												  ');
		$newAbilities->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$newAbilities->bindValue(':physics', $physics, PDO::PARAM_INT);
		$newAbilities->bindValue(':social', $social, PDO::PARAM_INT);
		$newAbilities->bindValue(':mental', $mental, PDO::PARAM_INT);
		$newAbilities->execute();
		$newAbilities->CloseCursor();
	}

	public function getAllCharacterAbilities($characterName) 
	{
		$preparedQuery = $this->_database->prepare('
												   SELECT physics, physics_ability, social, social_ability, mental, mental_ability
												   FROM charactersabilities
												   WHERE character_name = :character_name
												   ');
		$preparedQuery->bindValue(':character_name', $characterName, PDO::PARAM_STR);
		$preparedQuery->execute();
		$characterAbilities = $preparedQuery->fetchAll();
		$preparedQuery->CloseCursor();

		return $characterAbilities;
	}
}