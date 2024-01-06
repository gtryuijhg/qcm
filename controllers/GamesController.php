<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Games');
$charger->getValidator('Games');

class GamesController
{
	public function create($database)
	{
		if (!empty($_POST['gameName'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-game');

			$id = 0;
			$gameName = htmlspecialchars($_POST['gameName']);
			$masterName = htmlspecialchars($_SESSION['masterName']);

			//we check game name length
			$checkGameNameLength = new GamesValidatorImpl();
			$gameName = $checkGameNameLength->checkGameNameLength($gameName);

			//we check game name in base
			$getGameInBase = new GamesManagerImpl($database);
			$gameInBase = $getGameInBase->getGameNameInBase($gameName);

			//we check if game name is already taken
			$isGameNameAlreadyTaken = new GamesValidatorImpl();
			$gameName = $isGameNameAlreadyTaken->isGameNameAlreadyTaken($gameName, $gameInBase);

			//we add game
			$addGame = new GamesManagerImpl($database);
			$newGame = $addGame->addGame($id, $gameName, $masterName);

			//redirect at masters home
			redirect('/masters-home');

		} else {

			$userName = '';
		
			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			$masterName = htmlspecialchars($_SESSION['masterName']);
			
			//we get user status
			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "master");

			$createGameToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createGameToken;

			$title = 'Welcome to the game creation page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('games/create', [
				'title' => $title,
				'token' => $createGameToken,
			]);
		}
	}

	public function connect($database)
	{
		if (!empty($_POST['gameName'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/use-game');

			$userName = '';
		
			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			//we get user status
			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "master");
			
			$gameName = htmlspecialchars($_POST['gameName']);
			$masterName = htmlspecialchars($_SESSION['masterName']);

			//we take the game and master in base
			$checkGameNameWithMasterInBase = new GamesManagerImpl($database);
			$useGame = $checkGameNameWithMasterInBase->checkGameNameWithMasterInBase($gameName, $masterName);

			//we check if the game exists
			$isGameNameExists = new GamesValidatorImpl();
			$gameName = $isGameNameExists->isGameNameExists($gameName, $useGame);

			$_SESSION['gameName'] = $gameName;

			redirect('/games-home');

		} else {
			
			$userName = htmlspecialchars($_SESSION['userName']);
			$masterName = htmlspecialchars($_SESSION['masterName']);
			
			//we get user status
			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "master");

			$getGameToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $getGameToken;

			$title = 'Welcome to the game connection page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('games/connect', [
				'title' => $title,
				'token' => $getGameToken
			]);
		}
	}

	public function getHome($database)
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

		$title = 'Welcome to '.$gameName.' '.$userStatus.' '.$masterName.' !';

		$charger = new ClassCharger();
		$charger->getView('games/home', [
			'title' => $title,
			'game' => $gameName
		]);
	}

	public function listAllGames($database)
	{
		$userName = '';
		
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		//we get user status
		$getUserStatus = new UsersManagerImpl($database);
		$userStatus = $getUserStatus->getUserStatus($userName);

		$isUserStatus = new UsersValidatorImpl();
		$userStatus = $isUserStatus->isUserStatus($userStatus, "user");

		$getListOfGames = new GamesManagerImpl($database);
		$gamesList = $getListOfGames->getListOfGames();

		$title = 'Welcome to the games list '.$userStatus.' '.$userName.' !';

		$charger = new ClassCharger();
		$charger->getView('games/list', [
			'title' => $title,
			'gamesList' => $gamesList
		]);
	}
}