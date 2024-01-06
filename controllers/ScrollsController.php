<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('Scrolls');
$charger->getValidator('Scrolls');

class ScrollsController
{
	public function create($database)
	{
		if (!empty($_POST['scrollName'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-scrolls');

			$id = 0;
			$scrollName = htmlspecialchars($_POST['scrollName']);
			$gameName = htmlspecialchars($_SESSION['gameName']);

			$isScrollNameValid = new ScrollsValidatorImpl();
			$scrollName = $isScrollNameValid->isScrollNameValid($scrollName);

			$addScroll = new ScrollsManagerImpl($database);
			$addScroll->addScroll($id, $scrollName, $gameName);
			
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

			$createScrollsToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createScrollsToken;

			$title = 'Welcome to the scrolls creation page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('scrolls/create', [
				'title' => $title,
				'token' => $createScrollsToken,
				'game' => $gameName
			]);
			
		}
	}

	public function get($database)
	{
		if (!empty($_POST['scrollName']) && !empty($_POST['newScrollName'])) {

			$this->update($database);

		} else if (!empty($_POST['scrollName']) && !empty($_POST['userPassword'])) {

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

			$getScrollsList = new ScrollsManagerImpl($database);
			$scrollsList = $getScrollsList->getScrollsList($gameName);

			$scrollsToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $scrollsToken;

			$title = 'Welcome to '.$gameName.'\'s scrolls list page '.$userStatus.' '.$masterName.' !';

			$charger = new ClassCharger();
			$charger->getView('scrolls/get', [
				'title' => $title,
				'scrollsList' => $scrollsList,
				'token' => $scrollsToken,
				'game' => $gameName
			]);

		}
	}

	private function update($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-scrolls');

		$scrollName = htmlspecialchars($_POST['scrollName']);
		$newScrollName = htmlspecialchars($_POST['newScrollName']);
		$gameName = htmlspecialchars($_SESSION['gameName']);

		$isScrollNameValid = new ScrollsValidatorImpl();
		$scrollName = $isScrollNameValid->isScrollNameValid($scrollName);

		$isNewScrollNameValid = new ScrollsValidatorImpl();
		$newScrollName = $isNewScrollNameValid->isNewScrollNameValid($newScrollName);

		$updateScroll = new ScrollsManagerImpl($database);
		$updateScroll->updateScroll($scrollName, $newScrollName, $gameName);
		
		redirect('/get-scrolls');
	}

	private function delete($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-scrolls');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$gameName = htmlspecialchars($_SESSION['gameName']);
		$scrollName = htmlspecialchars($_POST['scrollName']);
		$password = htmlspecialchars($_POST['userPassword']);

		//we hash password
		$password = hashPassword($password);

		//we search user in base
		$searchUserAndPassword = new UsersManagerImpl($database);
		$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

		//we validate password
		$isYourUserPassword = new UsersValidatorImpl();
		$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

		//we delete scroll
		$deleteScroll = new ScrollsManagerImpl($database);
		$deleteScroll->deleteScroll($gameName, $scrollName);

		//we redirect at mobs sheet
		redirect('/get-scrolls');
	}
}