<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Villagers');
$charger->getValidator('Villagers');

class VillagersController
{
	public function create($database)
	{
		if (!empty($_POST['villagerName']) && !empty($_POST['villagerJob']) && !empty($_POST['villagerVillage'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-villagers');

			$id = 0;
			$villagerName = htmlspecialchars($_POST['villagerName']);
			$villagerJob = htmlspecialchars($_POST['villagerJob']);
			$villagerVillage = htmlspecialchars($_POST['villagerVillage']);
			$game = htmlspecialchars($_SESSION['gameName']);

			$isVillagerNameValid = new VillagersValidatorImpl();
			$villagerName = $isVillagerNameValid->isVillagerNameValid($villagerName);

			$isVillagerJobValid = new VillagersValidatorImpl();
			$villagerJob = $isVillagerJobValid->isVillagerJobValid($villagerJob);

			$isVillagerVillageValid = new VillagersValidatorImpl();
			$villagerVillage = $isVillagerVillageValid->isVillagerVillageValid($villagerVillage);

			$addVillager = new VillagersManagerImpl($database);
			$addVillager->addVillager($id, $villagerName, $villagerJob, $villagerVillage, $game);
			
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

			$createVillagersToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createVillagersToken;

			$title = 'Welcome to the villagers creation page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('villagers/create', [
				'title' => $title,
				'token' => $createVillagersToken,
				'game' => $gameName
			]);
		}
	}

	public function get($database)
	{
		if (!empty($_POST['villagerName']) && !empty($_POST['newVillagerName']) && !empty($_POST['villagerJob']) && !empty($_POST['villagerVillage'])) {

			$this->update($database);

		} else if (!empty($_POST['villagerName']) && !empty($_POST['userPassword'])) {

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

			$getVillagersList = new VillagersManagerImpl($database);
			$villagersList = $getVillagersList->getVillagersList($gameName);

			$villagersToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $villagersToken;

			$title = 'Welcome to '.$gameName.'\'s villagers list page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('villagers/get', [
				'title' => $title,
				'villagersList' => $villagersList,
				'token' => $villagersToken,
				'game' => $gameName
			]);

		}
	}

	private function update($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-villagers');

		$villagerName = htmlspecialchars($_POST['villagerName']);
		$newVillagerName = htmlspecialchars($_POST['newVillagerName']);
		$villagerJob = htmlspecialchars($_POST['villagerJob']);
		$villagerVillage = htmlspecialchars($_POST['villagerVillage']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		$isVillagerNameValid = new VillagersValidatorImpl();
		$villagerName = $isVillagerNameValid->isVillagerNameValid($villagerName);

		$isNewVillagerNameValid = new VillagersValidatorImpl();
		$newVillagerName = $isNewVillagerNameValid->isNewVillagerNameValid($newVillagerName);

		$isVillagerJobValid = new VillagersValidatorImpl();
		$villagerJob = $isVillagerJobValid->isVillagerJobValid($villagerJob);

		$isVillagerVillageValid = new VillagersValidatorImpl();
		$villagerVillage = $isVillagerVillageValid->isVillagerVillageValid($villagerVillage);

		$updateVillager = new VillagersManagerImpl($database);
		$updateVillager->updateVillager($villagerName, $newVillagerName, $villagerJob, $villagerVillage, $gameName);
		
		redirect('/get-villagers');
	}

	private function delete($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-villagers');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$gameName = htmlspecialchars($_SESSION['gameName']);
		$villagerName = htmlspecialchars($_POST['villagerName']);
		$password = htmlspecialchars($_POST['userPassword']);

		//we hash password
		$password = hashPassword($password);

		//we search user in base
		$searchUserAndPassword = new UsersManagerImpl($database);
		$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

		//we validate password
		$isYourUserPassword = new UsersValidatorImpl();
		$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

		//we delete villager
		$deleteVillager = new VillagersManagerImpl($database);
		$deleteVillager->deleteVillager($gameName, $villagerName);

		//we redirect at mobs sheet
		redirect('/get-villagers');
	}
}