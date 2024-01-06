<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Villages');
$charger->getValidator('Villages');

class VillagesController
{
	public function create($database)
	{
		if (!empty($_POST['villageName'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-villages');

			$id = 0;
			$villageName = htmlspecialchars($_POST['villageName']);
			$game = htmlspecialchars($_SESSION['gameName']);

			$isVillageNameValid = new VillagesValidatorImpl();
			$villageName = $isVillageNameValid->isVillageNameValid($villageName);

			$addVillage = new VillagesManagerImpl($database);
			$addVillage->addVillage($id, $villageName, $game);
			
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

			$createVillagesToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createVillagesToken;

			$title = 'Welcome to the villages creation page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('villages/create', [
				'title' => $title,
				'token' => $createVillagesToken,
				'game' => $gameName
			]);
		}
	}

	public function get($database)
	{
		if (!empty($_POST['villageName']) && !empty($_POST['newVillageName'])) {

			$this->update($database);

		} else if (!empty($_POST['villageName']) && !empty($_POST['userPassword'])) {

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

			$getVillagesList = new VillagesManagerImpl($database);
			$villagesList = $getVillagesList->getVillagesList($gameName);

			$villagesToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $villagesToken;

			$title = 'Welcome to '.$gameName.'\'s villages list page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('villages/get', [
				'title' => $title,
				'villagesList' => $villagesList,
				'token' => $villagesToken,
				'game' => $gameName
			]);

		}		
	}

	private function update($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-villages');

		$villageName = htmlspecialchars($_POST['villageName']);
		$newVillageName = htmlspecialchars($_POST['newVillageName']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		$isVillageNameValid = new VillagesValidatorImpl();
		$villageName = $isVillageNameValid->isVillageNameValid($villageName);

		$isNewVillageNameValid = new VillagesValidatorImpl();
		$newVillageName = $isNewVillageNameValid->isNewVillageNameValid($newVillageName);

		$updateVillage = new VillagesManagerImpl($database);
		$updateVillage->updateVillage($villageName, $newVillageName, $gameName);
		
		redirect('/get-villages');

	}

	private function delete($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-villages');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$gameName = htmlspecialchars($_SESSION['gameName']);
		$villageName = htmlspecialchars($_POST['villageName']);
		$password = htmlspecialchars($_POST['userPassword']);

		//we hash password
		$password = hashPassword($password);

		//we search user in base
		$searchUserAndPassword = new UsersManagerImpl($database);
		$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

		//we validate password
		$isYourUserPassword = new UsersValidatorImpl();
		$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

		//we delete village
		$deleteVillage = new VillagesManagerImpl($database);
		$deleteVillage->deleteVillage($gameName, $villageName);

		//we redirect at mobs sheet
		redirect('/get-villages');
	}
}