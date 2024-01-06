<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('CharactersStuff');
$charger->getValidator('CharactersStuff');

class CharactersStuffController
{
	public function create($database)
	{
		if (!empty($_POST['armor']) && !empty($_POST['weapon']) && !empty($_POST['backpackSlots'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-character-stuff');

			$id = 0;
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$armor = htmlspecialchars($_POST['armor']);
			$weapon = htmlspecialchars($_POST['weapon']);
			$backpackSlots = (int)($_POST['backpackSlots']);

			// we search if armor is valid
			$isArmorValid = new CharactersStuffValidatorImpl();
			$armor = $isArmorValid->isArmorValid($armor);

			// we search if weapon is valid
			$isWeaponValid = new CharactersStuffValidatorImpl();
			$weapon = $isWeaponValid->isWeaponValid($weapon);

			// we search if backpack is valid
			$isBackpackValid = new CharactersStuffValidatorImpl();
			$backpackSlots = $isBackpackValid->isBackpackValid($backpackSlots);

			// we take character stuff in base
			$getCharacterStuff = new CharactersStuffManagerImpl($database);
			$stuffInBase = $getCharacterStuff->getCharacterStuff($characterName);

			// we validate character stuff
			$isCharacterHasStuff = new CharactersStuffValidatorImpl();
			$characterName = $isCharacterHasStuff->isCharacterHasStuff($characterName, $stuffInBase);

			// we add character stuff
			$addStuff = new CharactersStuffManagerImpl($database);
			$addStuff->addStuff($id, $characterName, $armor, $weapon, $backpackSlots);

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

			$createCharactersStuffToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createCharactersStuffToken;

			$title = 'Welcome to the stuff creation page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stuff/create', [
				'title' => $title,
				'token' => $createCharactersStuffToken,
				'character' => $characterName
			]);
		}
	}

	public function updateWeapon($database)
	{
		if (!empty($_POST['weapon'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/update-character-weapon');

			$characterName = htmlspecialchars($_SESSION['characterName']);
			$weapon = htmlspecialchars($_POST['weapon']);

			//we take character weapon
			$getCharacterPostWeapon = new CharactersStuffManagerImpl($database);
			$weaponInBase = $getCharacterPostWeapon->getCharacterPostWeapon($weapon, $characterName);

			//we validate weapon
			$isSameWeapon = new CharactersStuffValidatorImpl();
			$weapon = $isSameWeapon->isSameWeapon($weaponInBase, $weapon);

			//we update weapon
			$updateWeapon = new CharactersStuffManagerImpl($database);
			$updateWeapon->updateWeapon($weapon, $characterName);

			//we redirect at characters home
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

			//we take character weapon
			$getCharacterWeapon = new CharactersStuffManagerImpl($database);
			$weaponInBase = $getCharacterWeapon->getCharacterWeapon($characterName);

			$updateCharactersWeaponToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $updateCharactersWeaponToken;

			$title = 'Welcome to the weapon update page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stuff/updateWeapon', [
				'title' => $title,
				'token' => $updateCharactersWeaponToken,
				'weapon' => $weaponInBase['weapon'],
				'character' => $characterName
			]);
		}
	}

	public function updateArmor($database)
	{
		if (!empty($_POST['armor'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/update-character-armor');

			$characterName = htmlspecialchars($_SESSION['characterName']);
			$armor = htmlspecialchars($_POST['armor']);

			//we take character armor
			$getCharacterPostArmor = new CharactersStuffManagerImpl($database);
			$armorInBase = $getCharacterPostArmor->getCharacterPostArmor($armor, $characterName);

			//we validate armor
			$isSameArmor = new CharactersStuffValidatorImpl();
			$armor = $isSameArmor->isSameArmor($armorInBase, $armor);

			//we update armor
			$updateArmor = new CharactersStuffManagerImpl($database);
			$updateArmor->updateArmor($armor, $characterName);

			//we redirect at characters home
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

			//we take character armor
			$getCharacterArmor = new CharactersStuffManagerImpl($database);
			$armorInBase = $getCharacterArmor->getCharacterArmor($characterName);

			$updateCharactersArmorToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $updateCharactersArmorToken;

			$title = 'Welcome to the armor update page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stuff/updateArmor', [
				'title' => $title,
				'token' => $updateCharactersArmorToken,
				'armor' => $armorInBase['armor'],
				'character' => $characterName
			]);
		}
	}

	public function addItemToBackpack($database)
	{
		if (!empty($_POST['itemName']) && !empty($_POST['itemSlots'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/add-item-to-backpack');

			$id = 0;
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$itemName = htmlspecialchars($_POST['itemName']);
			$itemSlots = (int)($_POST['itemSlots']);

			//we validate item slots (> 0)
			$isItemSlotsValid = new CharactersStuffValidatorImpl();
			$itemSlots = $isItemSlotsValid->isItemSlotsValid($itemSlots);

			// we add item to character backpack
			$addItemToCharacterBackpack = new CharactersStuffManagerImpl($database);
			$addItemToCharacterBackpack->addItemToBackpack($id, $characterName, $itemName, $itemSlots);

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

			$addItemToCharacterBackpackToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $addItemToCharacterBackpackToken;

			$title = 'Welcome to the backpack adding item page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stuff/addItemToBackpack', [
				'title' => $title,
				'token' => $addItemToCharacterBackpackToken,
				'character' => $characterName
			]);
		}
	}

	public function updateBackpack($database)
	{
		if (!empty($_POST['backpackSlots'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/update-character-backpack');

			$characterName = htmlspecialchars($_SESSION['characterName']);
			$backpackSlots = (int)($_POST['backpackSlots']);

			//we take character backpack
			$getCharacterPostBackpack = new CharactersStuffManagerImpl($database);
			$backpackInBase = $getCharacterPostBackpack->getCharacterPostBackpack($backpackSlots, $characterName);

			//we validate backpack
			$isSameBackpack = new CharactersStuffValidatorImpl();
			$backpack = $isSameBackpack->isSameBackpack($backpackInBase, $backpackSlots);

			//we update backpack
			$updateBackpack = new CharactersStuffManagerImpl($database);
			$updateBackpack->updateBackpack($backpackSlots, $characterName);

			//we redirect at characters home
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

			//we take character backpack
			$getCharacterBackpack = new CharactersStuffManagerImpl($database);
			$backpackInBase = $getCharacterBackpack->getCharacterBackpack($characterName);

			$updateCharactersBackpackToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $updateCharactersBackpackToken;

			$title = 'Welcome to the backpack update page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stuff/updateBackpack', [
				'title' => $title,
				'token' => $updateCharactersBackpackToken,
				'backpack' => $backpackInBase['backpack_slots'],
				'character' => $characterName
			]);
		}
	}

	public function getCharacterItems($database)
	{
		if (!empty($_POST['itemName']) && !empty($_POST['newItemName']) && !empty($_POST['itemSlots'])) {

			$this->updateCharacterItem($database);

		} else if (!empty($_POST['itemName']) && !empty($_POST['userPassword'])) {

			$this->deleteCharacterItem($database);

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

			//we get character backpack
			$getAllCharacterBackpack = new CharactersStuffManagerImpl($database);
			$characterBackpack = $getAllCharacterBackpack->getAllCharacterBackpack($characterName);

			$charactersItemToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $charactersItemToken;

			$title = 'Welcome to '.$characterName.'\'s items page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('stuff/itemsSheet', [
				'title' => $title,
				'item' => $characterBackpack,
				'character' => $characterName,
				'token' => $charactersItemToken,
			]);
		}
	}

	private function updateCharacterItem($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-character-items');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$characterName = htmlspecialchars($_SESSION['characterName']);
		$itemName = htmlspecialchars($_POST['itemName']);
		$newItemName = htmlspecialchars($_POST['newItemName']);
		$itemSlots = htmlspecialchars($_POST['itemSlots']);

		//we validate item slots (> 0)
		$isItemSlotsValid = new CharactersStuffValidatorImpl();
		$itemSlots = $isItemSlotsValid->isItemSlotsValid($itemSlots);
		
		//we update item
		$updateItem = new CharactersStuffManagerImpl($database);
		$updateItem->updateItem($characterName, $itemName, $newItemName, $itemSlots);

		//we redirect at items sheet
		redirect('/get-character-items');		
	}

	private function deleteCharacterItem($database)
	{
		checkTokens();

		//we check if the request came from the good form
		$validateForm = new FormsValidatorImpl();
		$validateForm->isGoodForm('/get-character-items');

		$userName = '';
	
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$characterName = htmlspecialchars($_SESSION['characterName']);
		$itemName = htmlspecialchars($_POST['itemName']);
		$password = htmlspecialchars($_POST['userPassword']);

		//we hash password
		$password = hashPassword($password);

		//we search user in base
		$searchUserAndPassword = new UsersManagerImpl($database);
		$searchUser = $searchUserAndPassword->searchUserAndPassword($userName, $password);

		//we validate password
		$isYourUserPassword = new UsersValidatorImpl();
		$password = $isYourUserPassword->isYourUserPassword($password, $searchUser);

		//we delete item
		$deleteItem = new CharactersStuffManagerImpl($database);
		$deleteItem->deleteItem($characterName, $itemName);

		//we redirect at items sheet
		redirect('/get-character-items');
	}
}