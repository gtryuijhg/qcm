<?php

Interface CharactersAbilitiesManager
{
	public function getCharacterAbilities($characterName);

	public function addAbilities($id, $characterName, $physics, $physicsAbility, $social, $socialAbility, $mental, $mentalAbility);

	public function getCharacterPhysics($characterName);

	public function getCharacterSocial($characterName);

	public function getCharacterMental($characterName);

	public function updateAbilities($physics, $social, $mental, $characterName);

	public function getAllCharacterAbilities($characterName);
}