<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Mobs');
$charger->getValidator('Mobs');

class MobsController
{
	public function create($database)
	{
		if (!empty($_POST['mobName']) && !empty($_POST['mobHealth']) && !empty($_POST['mobLevel']) && !empty($_POST['mobLocation'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-mobs');

			$id = 0;
			$mobName = htmlspecialchars($_POST['mobName']);
			$health = (int)($_POST['mobHealth']);
			$level = (int)($_POST['mobLevel']);
			$location = htmlspecialchars($_POST['mobLocation']);
			$gameName = htmlspecialchars($_SESSION['gameName']);

			$isMobNameValid = new MobsValidatorImpl();
			$mobName = $isMobNameValid->isMobNameValid($mobName);

			$isMobHealthValid = new MobsValidatorImpl();
			$health = $isMobHealthValid->isMobHealthValid($health);

			$isMobLevelValid = new MobsValidatorImpl();
			$level = $isMobLevelValid->isMobLevelValid($level);

			$isMobLocationValid = new MobsValidatorImpl();
			$location = $isMobLocationValid->isMobLocationValid($location);

			$addMob = new MobsManagerImpl($database);
			$addMob->addMob($id, $mobName, $health, $level, $location, $gameName);
			
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

			$createMobsToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createMobsToken;

			$title = 'Welcome to the mobs creation page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('mobs/create', [
				'title' => $title,
				'token' => $createMobsToken,
				'game' => $gameName
			]);
		}
	}

	public function get($database)
	{
		if (!empty($_POST['mobName']) && !empty($_POST['newMobName']) && !empty($_POST['mobHealth']) && !empty($_POST['mobLevel']) && !empty($_POST['mobLocation'])) {

			$this->update($database);

		} else if (!empty($_POST['mobName']) && !empty($_POST['userPassword'])) {

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

			$getMobsList = new MobsManagerImpl($database);
			$mobsList = $getMobsList->getMobsList($gameName);

			$mobsToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $mobsToken;

			$title = 'Welcome to '.$gameName.'\'s mobs list page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('mobs/get', [
				'title' => $title,
				'mobsList' => $mobsList,
				'token' => $mobsToken,
				'game' => $gameName
			]);

		}
	}

	private function update($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-mobs');

		$mobName = htmlspecialchars($_POST['mobName']);
		$newMobName = htmlspecialchars($_POST['newMobName']);
		$health = (int)($_POST['mobHealth']);
		$level = (int)($_POST['mobLevel']);
		$location = htmlspecialchars($_POST['mobLocation']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		$isMobNameValid = new MobsValidatorImpl();
		$mobName = $isMobNameValid->isMobNameValid($mobName);

		$isNewMobNameValid = new MobsValidatorImpl();
		$newMobName = $isNewMobNameValid->isNewMobNameValid($newMobName);

		$isMobHealthValid = new MobsValidatorImpl();
		$health = $isMobHealthValid->isMobHealthValid($health);

		$isMobLevelValid = new MobsValidatorImpl();
		$level = $isMobLevelValid->isMobLevelValid($level);

		$isMobLocationValid = new MobsValidatorImpl();
		$location = $isMobLocationValid->isMobLocationValid($location);

		$updateMob = new MobsManagerImpl($database);
		$updateMob->updateMob($mobName, $newMobName, $health, $level, $location, $gameName);
		
		redirect('/get-mobs');
	}

	private function delete($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-mobs');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$gameName = htmlspecialchars($_SESSION['gameName']);
		$mobName = htmlspecialchars($_POST['mobName']);
		$password = htmlspecialchars($_POST['userPassword']);

		//we hash password
		$password = hashPassword($password);

		//we search user in base
		$searchUserAndPassword = new UsersManagerImpl($database);
		$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

		//we validate password
		$isYourUserPassword = new UsersValidatorImpl();
		$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

		//we delete mob
		$deleteMob = new MobsManagerImpl($database);
		$deletemMob->deleteMob($gameName, $mobName);

		//we redirect at mobs sheet
		redirect('/get-mobs');
	}
}