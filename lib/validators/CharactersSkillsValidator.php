<?php

interface CharactersSkillsValidator
{
	public function isSkillNameValid($skillName):string;

	public function isSkillExists($skillInBase, $skillName):string;
}