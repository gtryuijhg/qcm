<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Players');
$charger->getValidator('Players');

class PlayersController
{
	public function create($database)
	{
		if (!empty($_POST['playerName']) && !empty($_POST['gameName']) && !empty($_POST['userPassword'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-player');

			$id = 0;
			$playerName = htmlspecialchars($_POST['playerName']);
			$gameName = htmlspecialchars($_POST['gameName']);
			$password = htmlspecialchars($_POST['userPassword']);
			$oldPlayersNumber = 0;

			$userName = '';

			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			//we take old players number in the game
			$getPlayersNumberByGame = new GamesManagerImpl($database);
			$oldPlayersNumber = $getPlayersNumberByGame->getPlayersNumberByGame($gameName, $oldPlayersNumber);

			//we check if player number is higher than 4 
			$validatePlayersNumber = new GamesValidatorImpl();
			$oldPlayersNumber = $validatePlayersNumber->validatePlayersNumber($oldPlayersNumber);

			//we check if player name is valid
			$isPlayerNameValid = new PlayersValidatorImpl();
			$playerName = $isPlayerNameValid->isPlayerNameValid($playerName);

			//we hash password
			$password = hashPassword($password);

			//we search user in base
			$searchUserAndPassword = new UsersManagerImpl($database);
			$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

			//we validate password
			$isYourUserPassword = new UsersValidatorImpl();
			$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

			//we get the player in base
			$getPlayerInBase = new PlayersManagerImpl($database);
			$playerInBase = $getPlayerInBase->getPlayerInBase($playerName);

			//we check if the player name is already taken
			$isPlayerNameAlreadyTaken = new PlayersValidatorImpl();
			$playerName = $isPlayerNameAlreadyTaken->isPlayerNameAlreadyTaken($playerName, $playerInBase);

			//we get the game name in base
			$getGameNameInBase = new GamesManagerImpl($database);
			$gameInBase = $getGameNameInBase->getGameNameInBase($gameName);

			//we check if the game exists
			$isGameNameExists = new GamesValidatorImpl();
			$gameName = $isGameNameExists->isGameNameExists($gameName, $gameInBase);

			//we add one player to the game
			$playersNumber = $oldPlayersNumber["players_number"] + 1;

			//we update players in game
			$setPlayerNumberInGame = new GamesManagerImpl($database);
			$newPlayersNumber = $setPlayerNumberInGame->setPlayerNumberInGame($gameName, $playersNumber);

			//we add the player in base
			$addPlayer = new PlayersManagerImpl($database);
			$newPlayer = $addPlayer->addPlayer($id, $playerName, $gameName, $userName);

			//we redirect at users home
			redirect('/users-home');

		} else {

			$userName = '';

			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);
			
			//we get user status
			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "user");

			$createPlayerToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createPlayerToken;

			$title = 'Welcome to the player creation page '.$userStatus.' '.$userName.' !';

			$charger = new ClassCharger();
			$charger->getView('players/create', [
				'title' => $title,
				'token' => $createPlayerToken
			]);
		}		
	}

	public function connect($database)
	{
		if (!empty($_POST['playerName']) && !empty($_POST['userPassword'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/connect-player');

			$playerName = htmlspecialchars($_POST['playerName']);
			$password = htmlspecialchars($_POST['userPassword']);
			$status = '';
			$userName = '';

			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			//we hash password
			$password = hashPassword($password);

			//we search user in base
			$searchUserAndPassword = new UsersManagerImpl($database);
			$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

			//we validate password
			$isYourUserPassword = new UsersValidatorImpl();
			$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

			//we take game in base
			$takeGameInBase = new PlayersManagerImpl($database);
			$gameName = $takeGameInBase->takeGameInBase($playerName);

			$gameName = $gameName['game_name'];

			//we take player in base
			$takePlayerInBase = new PlayersManagerImpl($database);
			$playerInBase = $takePlayerInBase->takePlayerInBase($playerName, $gameName, $userName);

			//we check if player exists
			$isPlayerNameExists = new PlayersValidatorImpl();
			$playerName = $isPlayerNameExists->isPlayerNameExists($playerName, $playerInBase);

			$_SESSION['gameName'] = $gameName;

			//we switch status
			$switchStatusAsPlayer = new UsersManagerImpl($database);
			$userStatus = $switchStatusAsPlayer->switchStatusAsPlayer($userName, $status);

			//we redirect at players home
			redirect('/players-home');
			
		} else {

			$userName = '';

			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);
			
			//we get user status
			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "user");
			
			$connectPlayerToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $connectPlayerToken;

			$title = 'Welcome to the player connection page '.$userStatus.' '.$userName.' !';

			$charger = new ClassCharger();
			$charger->getView('players/connect', [
				'title' => $title,
				'token' => $connectPlayerToken
			]);
		}		
	}

	public function getHome($database)
	{
		$playerName = htmlspecialchars($_SESSION['playerName']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		$userName = '';

		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		//we get user status
		$getUserStatus = new UsersManagerImpl($database);
		$userStatus = $getUserStatus->getUserStatus($userName);
	
		$isUserStatus = new UsersValidatorImpl();
		$userStatus = $isUserStatus->isUserStatus($userStatus, "player");

		$title = 'Welcome to '.$gameName.' '.$userStatus.' '.$playerName.' !';

		$charger = new ClassCharger();
		$charger->getView('players/home', [
			'title' => $title
		]);
	}
}