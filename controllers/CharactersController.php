<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Characters');
$charger->getValidator('Characters');
$charger->getManager('Players');
$charger->getValidator('Players');

class CharactersController
{
	public function create($database)
	{
		if (!empty($_POST['characterName'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-character');

			$id = 0;
			$characterName = htmlspecialchars($_POST['characterName']);
			$playerName = htmlspecialchars($_SESSION['playerName']);

			//we check character name length
			$checkCharacterNameLength = new CharactersValidatorImpl();
			$characterName = $checkCharacterNameLength->checkCharacterNameLength($characterName);

			//we check if character name has no number
			$checkNumberInCharacterName = new CharactersValidatorImpl();
			$characterName = $checkNumberInCharacterName->checkNumberInCharacterName($characterName);

			//we check if character name has no special character
			$checkSpecialCharacterInCharacterName = new CharactersValidatorImpl();
			$characterName = $checkSpecialCharacterInCharacterName->checkSpecialCharacterInCharacterName($characterName);

			//we take character name
			$getCharacterName = new CharactersManagerImpl($database);
			$characterNameInBase = $getCharacterName->getCharacterName($characterName);

			//we check if name is already taken
			$isCharacterNameAlreadyTaken = new CharactersValidatorImpl();
			$characterName = $isCharacterNameAlreadyTaken->isCharacterNameAlreadyTaken($characterName, $characterNameInBase);

			//we add character
			$addCharacter = new CharactersManagerImpl($database);
			$newCharacter = $addCharacter->addCharacter($id, $characterName, $playerName);

			redirect('/players-home');

		} else {

			$userName = '';
		
			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			$playerName = htmlspecialchars($_SESSION['playerName']);
			
			//we get user status
			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "player");

			$createCharacterToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createCharacterToken;

			$title = 'Welcome to the character creation page '.$userStatus.' '.$playerName.' !';


			$charger = new ClassCharger();
			$charger->getView('characters/create', [
				'title' => $title,
				'token' => $createCharacterToken
			]);
		}
	}

	public function connect($database)
	{
		if (!empty($_POST['characterName'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/use-character');

			$userName = '';

			$characterName = htmlspecialchars($_POST['characterName']);
			$playerName = htmlspecialchars($_SESSION['playerName']);

			$checkCharacterNameWithPlayerInBase = new CharactersManagerImpl($database);
			$useCharacter = $checkCharacterNameWithPlayerInBase->checkCharacterNameWithPlayerInBase($characterName, $playerName);

			$_SESSION['characterName'] = $useCharacter['character_name'];

			redirect('/characters-home');

		} else {

			$userName = '';
		
			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			$playerName = htmlspecialchars($_SESSION['playerName']);
			
			//we get user status
			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "player");

			$connectCharacterToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $connectCharacterToken;

			$title = 'Welcome to the character connection page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('characters/connect', [
				'title' => $title,
				'token' => $connectCharacterToken
			]);
		}
	}

	public function getHome($database)
	{
		$userName = '';
		
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);
		
		$playerName = htmlspecialchars($_SESSION['playerName']);
		$characterName = htmlspecialchars($_SESSION['characterName']);
		$gameName = htmlspecialchars($_SESSION['gameName']);
			
		//we get user status
		$getUserStatus = new UsersManagerImpl($database);
		$userStatus = $getUserStatus->getUserStatus($userName);

		$isUserStatus = new UsersValidatorImpl();
		$userStatus = $isUserStatus->isUserStatus($userStatus, "player");

		$title = 'Welcome to '.$gameName.' '.$userStatus.' '.$playerName.' !';

		$charger = new ClassCharger();
		$charger->getView('characters/home', [
			'title' => $title,
			'character' => $characterName
		]);
	}

	public function getYourCharacterSheet($database)
	{
		$userName = '';
		
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$playerName = htmlspecialchars($_SESSION['playerName']);
		$characterName = htmlspecialchars($_SESSION['characterName']);

		//we get user status
		$getUserStatus = new UsersManagerImpl($database);
		$userStatus = $getUserStatus->getUserStatus($userName);

		$isUserStatus = new UsersValidatorImpl();
		$userStatus = $isUserStatus->isUserStatus($userStatus, "player");

		//we get character infos
		$getAllCharacterInfos = new CharactersInfosManagerImpl($database);
		$characterInfos = $getAllCharacterInfos->getAllCharacterInfos($characterName);

		//we get character stats
		$getAllCharacterStats = new CharactersStatsManagerImpl($database);
		$characterStats = $getAllCharacterStats->getAllCharacterStats($characterName);

		//we get character abilities
		$getAllCharacterAbilities = new CharactersAbilitiesManagerImpl($database);
		$characterAbilities = $getAllCharacterAbilities->getAllCharacterAbilities($characterName);

		//we get character stuff
		$getAllCharacterStuff = new CharactersStuffManagerImpl($database);
		$characterStuff = $getAllCharacterStuff->getAllCharacterStuff($characterName);

		$title = 'Welcome to '.$characterName.'\'s sheet '.$userStatus.' '.$playerName.' !';

		$charger = new ClassCharger();
		$charger->getView('characters/yourCharacterSheet', [
			'title' => $title,
			'characterInfos' => $characterInfos,
			'characterStats' => $characterStats,
			'characterAbilities' => $characterAbilities,
			'characterStuff' => $characterStuff
		]);
	}

	public function getAllCharacters($database)
	{
	
		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$masterName = htmlspecialchars($_SESSION['masterName']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		//we get user status
		$getUserStatus = new UsersManagerImpl($database);
		$userStatus = $getUserStatus->getUserStatus($userName);

		$isUserStatus = new UsersValidatorImpl();
		$userStatus = $isUserStatus->isUserStatus($userStatus, "master");

		//we get all players
		$getAllPlayers = new PlayersManagerImpl($database);
		$playerName = $getAllPlayers->getAllPlayers($gameName);

		//we get the list of characters
		$getAllGameCharactersList = new CharactersManagerImpl($database);
		$charactersList = $getAllGameCharactersList->getAllGameCharactersList($playerName);

		$getCharacterToken = bin2hex(random_bytes(32));
		$_SESSION['token'] = $getCharacterToken;

		$title = 'Welcome to '.$gameName.'\'s characters\'s list '.$userStatus.' '.$masterName.' !';

		$charger = new ClassCharger();
		$charger->getView('characters/allCharactersSheets', [
			'title' => $title,
			'character' => $charactersList,
			'token' => $getCharacterToken
		]);	
	}

	public function getOneCharacterSheet($database)
	{
		if (!empty($_POST['characterName'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/get-all-characters');

			$userName = '';

			$characterName = htmlspecialchars($_POST['characterName']);
			$gameName = htmlspecialchars($_SESSION['gameName']);

			//we get character name and player name
			$getCharacter = new CharactersManagerImpl($database);
			$characterInBase = $getCharacter->getCharacter($characterName);

			//we check if character exist
			$isCharacterExist = new CharactersValidatorImpl();
			$characterName = $isCharacterExist->isCharacterExist($characterName, $characterInBase);

			$playerName = $characterInBase['player_name'];

			//we get the game of the player
			$getPlayerGame = new PlayersManagerImpl($database);
			$gameInBase = $getPlayerGame->getPlayerGame($playerName);

			//we check if the player game is the game of the character
			$isGoodGame = new PlayersValidatorImpl();
			$isGoodGame->isGoodGame($gameName, $gameInBase);

			$_SESSION['characterName'] = $characterName;

			redirect('/get-one-character');

		} else {

			$userName = '';
			
			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			$masterName = htmlspecialchars($_SESSION['masterName']);
			$characterName = htmlspecialchars($_SESSION['characterName']);

			//we get user status
			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "master");

			//we get character infos
			$getAllCharacterInfos = new CharactersInfosManagerImpl($database);
			$characterInfos = $getAllCharacterInfos->getAllCharacterInfos($characterName);

			//we get character stats
			$getAllCharacterStats = new CharactersStatsManagerImpl($database);
			$characterStats = $getAllCharacterStats->getAllCharacterStats($characterName);

			//we get character abilities
			$getAllCharacterAbilities = new CharactersAbilitiesManagerImpl($database);
			$characterAbilities = $getAllCharacterAbilities->getAllCharacterAbilities($characterName);

			//we get character stuff
			$getAllCharacterStuff = new CharactersStuffManagerImpl($database);
			$characterStuff = $getAllCharacterStuff->getAllCharacterStuff($characterName);

			$title = 'Welcome to '.$characterName.'\'s sheet '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('characters/oneCharacterSheet', [
				'title' => $title,
				'character' =>$characterName,
				'characterInfos' => $characterInfos,
				'characterStats' => $characterStats,
				'characterAbilities' => $characterAbilities,
				'characterStuff' => $characterStuff
			]);
		}	
	}
}