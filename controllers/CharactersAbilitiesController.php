<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('CharactersAbilities');
$charger->getValidator('CharactersAbilities');

class CharactersAbilitiesController
{
	public function create($database)
	{
		if (!empty($_POST['physics']) && !empty($_POST['social']) && !empty($_POST['mental']) && !empty($_POST['physicsAbility']) && !empty($_POST['socialAbility']) && !empty($_POST['mentalAbility'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-character-abilities');

			$id = 0;
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$physics = (int)($_POST['physics']);
			$physicsAbility = htmlspecialchars($_POST['physicsAbility']);
			$social = (int)($_POST['social']);
			$socialAbility = htmlspecialchars($_POST['socialAbility']);
			$mental = (int)($_POST['mental']);
			$mentalAbility = htmlspecialchars($_POST['mentalAbility']);

			//we check if physic value is valid
			$isPhysicsValid = new CharactersAbilitiesValidatorImpl();
			$physics = $isPhysicsValid->isPhysicsValid($physics);

			//we check if social value is valid
			$isSocialValid = new CharactersAbilitiesValidatorImpl();
			$social = $isSocialValid->isSocialValid($social);

			//we check if mental value is valid
			$isMentalValid = new CharactersAbilitiesValidatorImpl();
			$mental = $isMentalValid->isMentalValid($mental);

			//we check if physic ability is valid
			$isPhysicsAbilityValid = new CharactersAbilitiesValidatorImpl();
			$physicsAbility = $isPhysicsAbilityValid->isPhysicsAbilityValid($physicsAbility);

			//we check if social value is valid
			$isSocialAbilityValid = new CharactersAbilitiesValidatorImpl();
			$socialAbility = $isSocialAbilityValid->isSocialAbilityValid($socialAbility);

			//we check if mental value is valid
			$isMentalAbilityValid = new CharactersAbilitiesValidatorImpl();
			$mentalAbility = $isMentalAbilityValid->isMentalAbilityValid($mentalAbility);

			//we take character abilities
			$getCharacterAbilities = new CharactersAbilitiesManagerImpl($database);
			$characterInBase = $getCharacterAbilities->getCharacterAbilities($characterName);

			//we check if character has abilities
			$isCharacterHasAbilities = new CharactersAbilitiesValidatorImpl();
			$characterName = $isCharacterHasAbilities->isCharacterHasAbilities($characterInBase, $characterName);

			// we add character abilities
			$addAbilities = new CharactersAbilitiesManagerImpl($database);
			$addAbilities->addAbilities($id, $characterName, $physics, $physicsAbility, $social, $socialAbility, $mental, $mentalAbility);

			// we redirect at characters home
			redirect('/characters-home');

		} else {

			$userName = '';
		
			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);
			
			$playerName = htmlspecialchars($_SESSION['playerName']);
			$characterName = htmlspecialchars($_SESSION['characterName']);

			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "player");

			$createCharactersAbilitiesToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createCharactersAbilitiesToken;

			$title = 'Welcome to the abilities creation page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('abilities/create', [
				'title' => $title,
				'token' => $createCharactersAbilitiesToken,
				'character' => $characterName
			]);
		}
	}
}