<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Dungeons');
$charger->getValidator('Dungeons');

class DungeonsController
{
	public function create($database)
	{
		if (!empty($_POST['dungeonName']) && !empty($_POST['dungeonLevel'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-dungeons');

			$id = 0;
			$dungeonName = htmlspecialchars($_POST['dungeonName']);
			$level = (int)($_POST['dungeonLevel']);
			$gameName = htmlspecialchars($_SESSION['gameName']);

			$isDungeonNameValid = new DungeonsValidatorImpl();
			$dungeonName = $isDungeonNameValid->isDungeonNameValid($dungeonName);

			$isDungeonLevelValid = new DungeonsValidatorImpl();
			$level = $isDungeonLevelValid->isDungeonLevelValid($level);

			$addDungeon = new DungeonsManagerImpl($database);
			$addDungeon->addDungeon($id, $dungeonName, $level, $gameName);
			
			redirect('/games-home');

		} else {

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

			$createDungeonsToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createDungeonsToken;

			$title = 'Welcome to the dungeons creation page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('dungeons/create', [
				'title' => $title,
				'token' => $createDungeonsToken,
				'game' => $gameName
			]);
		}
	}

	public function get($database)
	{
		if (!empty($_POST['dungeonName']) && !empty($_POST['newDungeonName']) && !empty($_POST['dungeonLevel'])) {

			$this->update($database);

		} else if (!empty($_POST['dungeonName']) && !empty($_POST['userPassword'])) {

			$this->delete($database);
			
		} else {

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

			$getDungeonsList = new dungeonsManagerImpl($database);
			$dungeonsList = $getDungeonsList->getDungeonsList($gameName);

			$dungeonsToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $dungeonsToken;

			$title = 'Welcome to '.$gameName.'\'s dungeons list page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('dungeons/get', [
				'title' => $title,
				'dungeonsList' => $dungeonsList,
				'game' => $gameName,
				'token' => $dungeonsToken
			]);

		}
	}

	private function update($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-dungeons');

		$dungeonName = htmlspecialchars($_POST['dungeonName']);
		$newDungeonName = htmlspecialchars($_POST['newDungeonName']);
		$level = (int)($_POST['dungeonLevel']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		$isNewDungeonNameValid = new DungeonsValidatorImpl();
		$newDungeonName = $isNewDungeonNameValid->isNewDungeonNameValid($dungeonName);

		$isDungeonLevelValid = new DungeonsValidatorImpl();
		$level = $isDungeonLevelValid->isDungeonLevelValid($level);

		$updateDungeon = new DungeonsManagerImpl($database);
		$updateDungeon->updateDungeon($dungeonName, $newDungeonName, $level, $gameName);
		
		redirect('/get-dungeons');
	}

	private function delete($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-dungeons');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$gameName = htmlspecialchars($_SESSION['gameName']);
		$dungeonName = htmlspecialchars($_POST['dungeonName']);
		$password = htmlspecialchars($_POST['userPassword']);

		//we hash password
		$password = hashPassword($password);

		//we search user in base
		$searchUserAndPassword = new UsersManagerImpl($database);
		$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

		//we validate password
		$isYourUserPassword = new UsersValidatorImpl();
		$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

		//we delete dungeon
		$deleteDungeon = new DungeonsManagerImpl($database);
		$deleteDungeon->deleteDungeon($gameName, $dungeonName);

		//we redirect at dungeons sheet
		redirect('/get-dungeons');
	}
}