<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Masters');
$charger->getValidator('Masters');

class MastersController
{
	public function create($database)
	{
		if (!empty($_POST['masterName']) && !empty($_POST['userPassword'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-master');

			$id = 0;
			$masterName = htmlspecialchars($_POST['masterName']);
			$password = htmlspecialchars($_POST['userPassword']);
			$userName = '';
			
			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			//we check if master name is valid
			$isMasterNameValid = new MastersValidatorImpl();
			$masterName = $isMasterNameValid->isMasterNameValid($masterName);

			//we search master in base
			$searchMasterInBase = new MastersManagerImpl($database);
			$masterInBase = $searchMasterInBase->searchMasterInBase($masterName);

			//we search if master is already taken
			$isMasterAlreadyTaken = new MastersValidatorImpl();
			$masterName = $isMasterAlreadyTaken->isMasterAlreadyTaken($masterName, $masterInBase);

			//we hash password
			$password = hashPassword($password);

			//we search user in base
			$searchUserAndPassword = new UsersManagerImpl($database);
			$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

			//we validate password
			$isYourUserPassword = new UsersValidatorImpl();
			$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

			//we add master
			$addMaster = new MastersManagerImpl($database);
			$newMaster = $addMaster->addMaster($id, $masterName, $userName);

			//redirect at users home
			redirect('users-home');
			
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

			$createMasterToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createMasterToken;

			$title = 'Welcome to the master creation page '.$userStatus.' '.$userName.' !';

			$charger = new ClassCharger();
			$charger->getView('masters/create', [
				'title' => $title,
				'token' => $createMasterToken
			]);
		}
	}

	public function connect($database)
	{
		if (!empty($_POST['masterName']) && !empty($_POST['userPassword'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/connect-master');

			$userName = '';

			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);

			$masterName = htmlspecialchars($_POST['masterName']);
			$password = htmlspecialchars($_POST['userPassword']);
			$status = '';

			//we hash password
			$password = hashPassword($password);

			//we search user in base
			$searchUserAndPassword = new UsersManagerImpl($database);
			$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

			//we validate password
			$isYourUserPassword = new UsersValidatorImpl();
			$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

			//we use master
			$checkMasterInBase = new MastersManagerImpl($database);
			$useMaster = $checkMasterInBase->checkMasterInBase($masterName, $userName);

			$_SESSION['masterName'] = $masterName;

			//we switch status
			$switchStatusAsMaster = new UsersManagerImpl($database);
			$userStatus = $switchStatusAsMaster->switchStatusAsMaster($userName, $status);

			//we redirect at masters home
			redirect('/masters-home');

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

			$connectMasterToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $connectMasterToken;

			$title = 'Welcome to the master connection page '.$userStatus.' '.$userName.' !';

			$charger = new ClassCharger();
			$charger->getView('masters/connect', [
				'title' => $title,
				'token' => $connectMasterToken
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

		//we get user status
		$getUserStatus = new UsersManagerImpl($database);
		$userStatus = $getUserStatus->getUserStatus($userName);
	
		$isUserStatus = new UsersValidatorImpl();
		$userStatus = $isUserStatus->isUserStatus($userStatus, "master");

		$title = 'Welcome to masters home '.$userStatus.' '.$masterName.' !';

		$charger = new ClassCharger();
		$charger->getView('masters/home', [
			'title' => $title
		]);
	}
}