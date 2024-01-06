<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Keys');
$charger->getValidator('Keys');

class KeysController
{
	public function create($database)
	{
		if (!empty($_POST['keyName'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-keys');

			$id = 0;
			$keyName = htmlspecialchars($_POST['keyName']);
			$gameName = htmlspecialchars($_SESSION['gameName']);

			$isKeyNameValid = new KeysValidatorImpl();
			$keyName = $isKeyNameValid->isKeyNameValid($keyName);

			$addKey = new KeysManagerImpl($database);
			$addKey->addKey($id, $keyName, $gameName);
			
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

			$createKeysToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createKeysToken;

			$title = 'Welcome to the keys creation page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('keys/create', [
				'title' => $title,
				'token' => $createKeysToken,
				'game' => $gameName
			]);

		}
	}

	public function get($database)
	{
		if (!empty($_POST['keyName']) && !empty($_POST['newKeyName'])) {

			$this->update($database);

		} else if (!empty($_POST['keyName']) && !empty($_POST['userPassword'])) {

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

			$getKeysList = new KeysManagerImpl($database);
			$keysList = $getKeysList->getKeysList($gameName);

			$keysToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $keysToken;

			$title = 'Welcome to '.$gameName.'\'s keys list page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('keys/get', [
				'title' => $title,
				'keysList' => $keysList,
				'token' => $keysToken,
				'game' => $gameName
			]);

		}
	}

	private function update($database)
	{

		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-keys');

		$keyName = htmlspecialchars($_POST['keyName']);
		$newKeyName = htmlspecialchars($_POST['newKeyName']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		$isKeyNameValid = new KeysValidatorImpl();
		$keyName = $isKeyNameValid->isKeyNameValid($keyName);

		$isNewKeyNameValid = new KeysValidatorImpl();
		$newKeyName = $isNewKeyNameValid->isNewKeyNameValid($newKeyName);

		$updateKey = new KeysManagerImpl($database);
		$updateKey->updateKey($keyName, $newKeyName, $gameName);
		
		redirect('/get-keys');

	}

	private function delete($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-keys');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$gameName = htmlspecialchars($_SESSION['gameName']);
		$keyName = htmlspecialchars($_POST['keyName']);
		$password = htmlspecialchars($_POST['userPassword']);

		//we hash password
		$password = hashPassword($password);

		//we search user in base
		$searchUserAndPassword = new UsersManagerImpl($database);
		$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

		//we validate password
		$isYourUserPassword = new UsersValidatorImpl();
		$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

		//we delete key
		$deleteKey = new KeysManagerImpl($database);
		$deleteKey->deleteKey($gameName, $keyName);

		//we redirect at keys sheet
		redirect('/get-keys');
	}
}