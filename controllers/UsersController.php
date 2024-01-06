<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

class UsersController
{
	public function connect($database)
	{	
		if (!empty($_POST['userLogin']) && !empty($_POST['userPassword'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/');

			$login = htmlspecialchars($_POST['userLogin']);
			$password = htmlspecialchars($_POST['userPassword']);
			$status = '';

			//we hash login
			$login = hashLogin($login);

			//we hash password
			$password = hashPassword($password);

			//we connect user
			$userConnection = new UsersManagerImpl($database);
			$connectUser = $userConnection->userConnection($login, $password);

			//we validate login 
			$isSameLogins = new UsersValidatorImpl();
			$login = $isSameLogins->isSameLogins($login, $connectUser);

			//we validate password 
			$isSamePasswords = new UsersValidatorImpl();
			$password = $isSamePasswords->isSamePasswords($password, $connectUser);

			$_SESSION['userName'] = $connectUser['user_name'];

			redirect('/users-home');

		} else {

			$connectUserToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $connectUserToken;

			$title = 'Welcome to my paper role play game hub !';

			$charger = new ClassCharger();
			$charger->getView('users/connect', [
				'title' => $title,
				'token' => $connectUserToken
			]);
		}		
	}

	public function create($database)
	{
		if (!empty($_POST['userName']) && !empty($_POST['userLogin']) && !empty($_POST['userPassword'])) {
		
			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-user');

			$id = 0;
			$name = htmlspecialchars($_POST['userName']);
			$login = htmlspecialchars($_POST['userLogin']);
			$password = htmlspecialchars($_POST['userPassword']);
			$status = 'user';

			//we search if user name is valid
			$isUserNameValid = new UsersValidatorImpl();
			$name = $isUserNameValid->isUserNameValid($name);

			//we search user in base
			$searchUserInBase = new UsersManagerImpl($database);
			$userInBase = $searchUserInBase->searchUserInBase($name);

			//we search if user is already taken
			$isUserAlreadyTaken = new UsersValidatorImpl();
			$name = $isUserAlreadyTaken->isUserAlreadyTaken($name, $userInBase);

			//we search if user login is valid
			$isUserLoginValid = new UsersValidatorImpl();
			$login = $isUserLoginValid->isUserLoginValid($login);

			//we hash login
			$hashLogin = hashLogin($login);

			//we search login in base
			$searchLoginInBase = new UsersManagerImpl($database);
			$loginInBase = $searchLoginInBase->searchLoginInBase($hashLogin);

			//we search if login is already taken
			$isLoginAlreadyTaken = new UsersValidatorImpl();
			$hashLogin = $isLoginAlreadyTaken->isLoginAlreadyTaken($hashLogin, $loginInBase);

			//we search if user password is valid
			$isUserPasswordValid = new UsersValidatorImpl();
			$password = $isUserPasswordValid->isUserPasswordValid($password);

			//we hash password
			$hashPassword = hashPassword($password);

			//we add user
			$addUser = new UsersManagerImpl($database);
			$newUser = $addUser->addUser($id, $name, $hashLogin, $hashPassword, $status);

			//redirect at connection page
			redirect('/');
								
		} else {
			
			$createUserToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createUserToken;

			$title = 'Welcome to the user creation page !';

			$charger = new ClassCharger();
			$charger->getView('users/create', [
				'title' => $title,
				'token' => $createUserToken
			]);
		}		
	}

	public function getHome($database)
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

		$title = 'Welcome to users home '.$userStatus.' '.$userName.' !';

		$charger = new ClassCharger();
		$charger->getView('users/home', [
			'title' => $title
		]);
	}

	public function disconnect()
	{
		$_SESSION = [];
		session_destroy();

		redirect('/');
	}

	public function return($database)
	{
		$userName = '';
		
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		//we get user status
		$getUserStatus = new UsersManagerImpl($database);
		$userStatus = $getUserStatus->getUserStatus($userName);

		$switchStatusAsUser = new UsersManagerImpl($database);
		$userStatus = $switchStatusAsUser->switchStatusAsUser($userName, $userStatus);

		redirect('/users-home');
	}
}