<?php

interface CharactersSkillsManager
{
	public function addSkill($id, $character, $skillName, $skillDescription);

	public function getAllCharacterSkills($characterName);
}