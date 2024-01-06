<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('CharactersInfos');
$charger->getValidator('CharactersInfos');

class CharactersInfosController
{
	public function create($database)
	{
		if (!empty($_POST['characterClass']) && !empty($_POST['particularity'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-character-infos');

			$id = 0;
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$class = htmlspecialchars($_POST['characterClass']);
			$particularity = htmlspecialchars($_POST['particularity']);

			//we check if class has a number
			$checkNumberInClass = new CharactersInfosValidatorImpl();
			$class = $checkNumberInClass->checkNumberInClass($class);

			//we check if class has a special character
			$checkSpecialCharacterInClass = new CharactersInfosValidatorImpl();
			$class = $checkSpecialCharacterInClass->checkSpecialCharacterInClass($class);

			//we check if particularity has a number
			$checkNumberInParticularity = new CharactersInfosValidatorImpl();
			$particularity = $checkNumberInParticularity->checkNumberInParticularity($particularity);

			//we check character infos
			$checkCharacterInfos = new CharactersInfosManagerImpl($database);
			$characterInBase = $checkCharacterInfos->checkCharacterInfos($characterName);

			// we validate character infos
			$validateCharacterInfos = new CharactersInfosValidatorImpl();
			$characterName = $validateCharacterInfos->isCharacterInfosExists($characterInBase, $characterName);

			// we add character infos
			$addInfos = new CharactersInfosManagerImpl($database);
			$addInfos->addInfos($id, $characterName, $class, $particularity);

			// we redirect at characters home
			redirect('/characters-home');

		} else {

			$userName = '';
		
			//we check if user is connected
			$isConnected = new UsersValidatorImpl();
			$userName = $isConnected->isConnected($userName);
			
			$playerName = htmlspecialchars($_SESSION['playerName']);
			$characterName = htmlspecialchars($_SESSION['characterName']);

			$getUserStatus = new UsersManagerImpl($database);
			$userStatus = $getUserStatus->getUserStatus($userName);

			$isUserStatus = new UsersValidatorImpl();
			$userStatus = $isUserStatus->isUserStatus($userStatus, "player");

			$createCharactersInfosToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createCharactersInfosToken;

			$title = 'Welcome to the infos creation page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('infos/create', [
				'title' => $title,
				'token' => $createCharactersInfosToken,
				'character' => $characterName
			]);
		}
	}
}