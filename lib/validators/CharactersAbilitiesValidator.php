<?php

Interface CharactersAbilitiesValidator
{
	public function isPhysicsValid($physics):int;

	public function isSocialValid($social):int;

	public function isMentalValid($mental):int;

	public function isPhysicsAbilityValid($physicsAbility):string;

	public function isSocialAbilityValid($socialAbility):string;

	public function isMentalAbilityValid($mentalAbility):string;

	public function isCharacterHasAbilities($characterInBase, $characterName):string;
}