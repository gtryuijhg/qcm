<?php

require_once 'CharactersSkillsValidator.php';

class CharactersSkillsValidatorImpl implements CharactersSkillsValidator
{
	public function isSkillNameValid($skillName):string
	{
		if (preg_match('#[0-9]#', $skillName)) {
			throw new UserException('Your skill name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9\s]#', $skillName)) {
			throw new UserException('Your skill name cannot contain a special character !');
		} else {
			return $skillName;
		}
	}

	public function isSkillExists($skillInBase, $skillName):string
	{
		if (strtolower($skillName) === strtolower($skillInBase['skill_name'])) {
			return $skillName;
		} else {
			throw new UserException('Skill not found !');
		}
	}
}