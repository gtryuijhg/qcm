<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('CharactersStats');
$charger->getValidator('CharactersStats');
$charger->getManager('CharactersAbilities');

class CharactersStatsController
{
	public function create($database)
	{
		if (!empty($_POST['health']) && !empty($_POST['energy'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-character-stats');

			$id = 0;
			$level = 1;
			$health = (int)($_POST['health']);
			$maxHealth = $health;
			$energy = (int)($_POST['energy']);
			$maxEnergy = $energy;
			$characterName = htmlspecialchars($_SESSION['characterName']);

			//we check if character health is valid
			$isCharacterHealthValid = new CharactersStatsValidatorImpl();
			$health = $isCharacterHealthValid->isCharacterHealthValid($health);

			//we check if character energy is valid
			$isCharacterEnergyValid = new CharactersStatsValidatorImpl();
			$energy = $isCharacterEnergyValid->isCharacterEnergyValid($energy);

			// we take character stats
			$getCharacterStats = new CharactersStatsManagerImpl($database);
			$characterInBase = $getCharacterStats->getCharacterStats($characterName);

			// we check if character has stats
			$isCharacterHasStats = new CharactersStatsValidatorImpl();
			$characterName = $isCharacterHasStats->isCharacterHasStats($characterName, $characterInBase);

			// we add character stats
			$addStats = new CharactersStatsManagerImpl($database);
			$addStats->addStats($id, $level, $health, $maxHealth, $energy, $maxEnergy, $characterName);

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

			$createCharactersStatsToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createCharactersStatsToken;

			$title = 'Welcome to the stats creation page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stats/create', [
				'title' => $title,
				'token' => $createCharactersStatsToken,
				'character' => $characterName
			]);
		}
	}

	public function levelUp($database)
	{
		if (!empty($_POST['addHealth']) && !empty($_POST['addEnergy'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/level-up');

			$addHealth = (int) $_POST['addHealth'];
			$addEnergy = (int) $_POST['addEnergy'];
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$health = 0;
			$maxHealth = 0;
			$energy = 0;
			$maxEnergy = 0;
			$level = 0;

			$isStatsValid = new CharactersStatsVaidatorImpl();
			$isStatsValid->isStatsValid($addHealth, $addEnergy);			

			//we take character level
			$getCharacterLevel = new CharactersStatsManagerImpl($database);
			$level = $getCharacterLevel->getCharacterLevel($characterName);

			//we check if level is maxed
			$isLevelMax = new CharactersStatsValidatorImpl();
			$level = $isLevelMax->isLevelMax($level);

			//we take character health
			$levelUpCharacterHealth = new CharactersStatsManagerImpl($database);
			$health = $levelUpCharacterHealth->levelUpCharacterHealth($characterName, $addHealth);

			//we take character max health
			$levelUpCharacterMaxHealth = new CharactersStatsManagerImpl($database);
			$maxHealth = $levelUpCharacterMaxHealth->levelUpCharacterMaxHealth($characterName, $addHealth);

			//we take character energy
			$levelUpCharacterEnergy = new CharactersStatsManagerImpl($database);
			$energy = $levelUpCharacterEnergy->levelUpCharacterEnergy($characterName, $addEnergy);

			//we take character max energy
			$levelUpCharacterMaxEnergy = new CharactersStatsManagerImpl($database);
			$maxEnergy = $levelUpCharacterMaxEnergy->levelUpCharacterMaxEnergy($characterName, $addEnergy);

			if ($level === 5 || $level === 10) {

				//we take character physics
				$getCharacterPhysics = new CharactersAbilitiesManagerImpl($database);
				$physics = $getCharacterPhysics->getCharacterPhysics($characterName);

				//we take character social
				$getCharacterSocial = new CharactersAbilitiesManagerImpl($database);
				$social = $getCharacterSocial->getCharacterSocial($characterName);

				//we take character mental
				$getCharacterMental = new CharactersAbilitiesManagerImpl($database);
				$mental = $getCharacterMental->getCharacterMental($characterName);

				//we update character abilities
				$updateAbilities = new CharactersAbilitiesManagerImpl($database);
				$newAbilities = $updateAbilities->updateAbilities($physics, $social, $mental, $characterName);
			}

			//we update character stats
			$updateStats = new CharactersStatsManagerImpl($database);
			$newStats = $updateStats->updateStats($health, $maxHealth, $energy, $maxEnergy, $level, $characterName);

			//we redirect at characters home
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

			$levelUpToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $levelUpToken;

			$title = 'Welcome to the level up page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stats/levelUp', [
				'title' => $title,
				'token' => $levelUpToken,
				'character' => $characterName
			]);
		}
	}

	public function increaseHealth($database)
	{
		if (!empty($_POST['pointsNumber'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/increase-character-health');

			$pointsNumber = (int)($_POST['pointsNumber']);
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$health = 0;
			$maxHealth = 0;

			//we check if pointNuber is valid
			$isPointsNumberValid = new CharactersStatsValidatorImpl();
			$pointsNumber = $isPointsNumberValid->isPointsNumberValid($pointsNumber);

			//we take character health
			$getCharacterHealth = new CharactersStatsManagerImpl($database);
			$health = $getCharacterHealth->getCharacterHealth($health, $characterName);

			$maxHealth = $health['max_health'];

			$increaseHealth = new CharactersStatsValidatorImpl();
			$health = $increaseHealth->increaseHealth($health, $maxHealth, $pointsNumber);

			$updateCharacterHealth = new CharactersStatsManagerImpl($database);
			$updateCharacterHealth->updateCharacterHealth($health, $characterName);

			redirect('/get-character-sheet');

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

			$increaseHealthToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $increaseHealthToken;

			$title = 'Welcome to the increase health page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stats/increaseHealth', [
				'title' => $title,
				'token' => $increaseHealthToken,
				'character' => $characterName
			]);
		}
	}

	public function reduceHealth($database)
	{
		if (!empty($_POST['pointsNumber'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/reduce-character-health');

			$pointsNumber = (int)($_POST['pointsNumber']);
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$health = 0;
			$maxHealth = 0;

			//we check if pointNuber is valid
			$isPointsNumberValid = new CharactersStatsValidatorImpl();
			$pointsNumber = $isPointsNumberValid->isPointsNumberValid($pointsNumber);

			//we take character health
			$getCharacterHealth = new CharactersStatsManagerImpl($database);
			$health = $getCharacterHealth->getCharacterHealth($health, $characterName);

			$reduceHealth = new CharactersStatsValidatorImpl();
			$health = $reduceHealth->reduceHealth($health, $pointsNumber);

			$updateCharacterHealth = new CharactersStatsManagerImpl($database);
			$updateCharacterHealth->updateCharacterHealth($health, $characterName);

			redirect('/get-character-sheet');

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

			$reduceHealthToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $reduceHealthToken;

			$title = 'Welcome to the reduce health page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stats/reduceHealth', [
				'title' => $title,
				'token' => $reduceHealthToken,
				'character' => $characterName
			]);
		}
	}

	public function increaseEnergy($database)
	{
		if (!empty($_POST['pointsNumber'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/increase-character-energy');

			$pointsNumber = (int)($_POST['pointsNumber']);
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$energy = 0;
			$maxEnergy = 0;

			//we check if pointNuber is valid
			$isPointsNumberValid = new CharactersStatsValidatorImpl();
			$pointsNumber = $isPointsNumberValid->isPointsNumberValid($pointsNumber);

			//we take character energy
			$getCharacterEnergy = new CharactersStatsManagerImpl($database);
			$energy = $getCharacterEnergy->getCharacterEnergy($energy, $characterName);

			$maxEnergy = $energy['max_energy'];

			$increaseEnergy = new CharactersStatsValidatorImpl();
			$energy = $increaseEnergy->increaseEnergy($energy, $maxEnergy, $pointsNumber);

			$updateCharacterEnergy = new CharactersStatsManagerImpl($database);
			$updateCharacterEnergy->updateCharacterEnergy($energy, $characterName);

			redirect('/get-character-sheet');

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

			$increaseEnergyToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $increaseEnergyToken;

			$title = 'Welcome to the increase energy page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stats/increaseEnergy', [
				'title' => $title,
				'token' => $increaseEnergyToken,
				'character' => $characterName
			]);
		}
	}

	public function reduceEnergy($database)
	{
		if (!empty($_POST['pointsNumber'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/reduce-character-energy');

			$pointsNumber = (int)($_POST['pointsNumber']);
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$energy = 0;
			$maxEnergy = 0;

			//we check if pointNuber is valid
			$isPointsNumberValid = new CharactersStatsValidatorImpl();
			$pointsNumber = $isPointsNumberValid->isPointsNumberValid($pointsNumber);

			//we take character energy
			$getCharacterEnergy = new CharactersStatsManagerImpl($database);
			$energy = $getCharacterEnergy->getCharacterEnergy($energy, $characterName);

			$reduceEnergy = new CharactersStatsValidatorImpl();
			$energy = $reduceEnergy->reduceEnergy($energy, $pointsNumber);

			$updateCharacterEnergy = new CharactersStatsManagerImpl($database);
			$updateCharacterEnergy->updateCharacterEnergy($energy, $characterName);

			redirect('/get-character-sheet');

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

			$reduceEnergyToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $reduceEnergyToken;

			$title = 'Welcome to the reduce energy page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stats/reduceEnergy', [
				'title' => $title,
				'token' => $reduceEnergyToken,
				'character' => $characterName
			]);
		}
	}
}