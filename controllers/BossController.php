<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Boss');
$charger->getValidator('Boss');

class BossController
{
	public function create($database)
	{
		if (!empty($_POST['bossName']) && !empty($_POST['bossHealth']) && !empty($_POST['bossLevel']) && !empty($_POST['bossLocation'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-boss');

			$id = 0;
			$bossName = htmlspecialchars($_POST['bossName']);
			$health = (int)($_POST['bossHealth']);
			$level = (int)($_POST['bossLevel']);
			$location = htmlspecialchars($_POST['bossLocation']);
			$gameName = htmlspecialchars($_SESSION['gameName']);

			$isBossNameValid = new BossValidatorImpl();
			$bossName = $isBossNameValid->isBossNameValid($bossName);

			$isBossHealthValid = new BossValidatorImpl();
			$health = $isBossHealthValid->isBossHealthValid($health);

			$isBossLevelValid = new BossValidatorImpl();
			$level = $isBossLevelValid->isBossLevelValid($level);

			$isBossLocationValid = new BossValidatorImpl();
			$location = $isBossLocationValid->isBossLocationValid($location);

			$addBoss = new BossManagerImpl($database);
			$addBoss->addBoss($id, $bossName, $health, $level, $location, $gameName);
			
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

			$createBossToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createBossToken;

			$title = 'Welcome to the boss creation page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('boss/create', [
				'title' => $title,
				'token' => $createBossToken,
				'game' => $gameName
			]);
		}
	}

	public function get($database)
	{
		if (!empty($_POST['bossName']) && !empty($_POST['newBossName']) && !empty($_POST['bossHealth']) && !empty($_POST['bossLevel']) && !empty($_POST['bossLocation'])) {

			$this->update($database);

		} else if (!empty($_POST['bossName']) && !empty($_POST['userPassword'])) {

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

			$getBossList = new BossManagerImpl($database);
			$bossList = $getBossList->getBossList($gameName);

			$bossToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $bossToken;

			$title = 'Welcome to '.$gameName.'\'s boss list page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('boss/get', [
				'title' => $title,
				'bossList' => $bossList,
				'game' => $gameName,
				'token' => $bossToken
			]);
			
		}
	}

	private function update($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-boss');

		$bossName = htmlspecialchars($_POST['bossName']);
		$newBossName = htmlspecialchars($_POST['newBossName']);
		$health = (int)($_POST['bossHealth']);
		$level = (int)($_POST['bossLevel']);
		$location = htmlspecialchars($_POST['bossLocation']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		$isBossNameValid = new BossValidatorImpl();
		$bossName = $isBossNameValid->isBossNameValid($bossName);

		$isNewBossNameValid = new BossValidatorImpl();
		$newBossName = $isNewBossNameValid->isNewBossNameValid($newBossName);

		$isBossHealthValid = new BossValidatorImpl();
		$health = $isBossHealthValid->isBossHealthValid($health);

		$isBossLevelValid = new BossValidatorImpl();
		$level = $isBossLevelValid->isBossLevelValid($level);

		$isBossLocationValid = new BossValidatorImpl();
		$location = $isBossLocationValid->isBossLocationValid($location);

		$updateBoss = new BossManagerImpl($database);
		$updateBoss->updateBoss($bossName, $newBossName, $health, $level, $location, $gameName);
		
		redirect('/get-boss');
	}

	private function delete($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-boss');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$gameName = htmlspecialchars($_SESSION['gameName']);
		$bossName = htmlspecialchars($_POST['bossName']);
		$password = htmlspecialchars($_POST['userPassword']);

		//we hash password
		$password = hashPassword($password);

		//we search user in base
		$searchUserAndPassword = new UsersManagerImpl($database);
		$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

		//we validate password
		$isYourUserPassword = new UsersValidatorImpl();
		$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

		//we delete boss
		$deleteBoss = new BossManagerImpl($database);
		$deleteBoss->deleteBoss($gameName, $bossName);

		//we redirect at boss sheet
		redirect('/get-boss');
	}
}