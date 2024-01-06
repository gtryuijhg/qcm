<?php

session_start();

//PDO
require_once 'lib/database/PDOConnection.php';

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

//exceptions
$charger->getException('InvalidForm');
$charger->getException('PageNotFound');
$charger->getException('InvalidParameter');
$charger->getException('AccessDenied');
$charger->getException('User');

//validators and managers
$charger->getManager('Users');

$charger->getValidator('Forms');
$charger->getValidator('Users');

//functions
require_once 'functions/globalFunctions.php';

//controllers
$charger->getController('Users');
$charger->getController('Masters');
$charger->getController('Players');
$charger->getController('Games');
$charger->getController('Characters');
$charger->getController('CharactersInfos');
$charger->getController('CharactersStats');
$charger->getController('CharactersAbilities');
$charger->getController('CharactersSkills');
$charger->getController('CharactersStuff');
$charger->getController('Boss');
$charger->getController('Dungeons');
$charger->getController('Mobs');
$charger->getController('Villagers');
$charger->getController('Villages');
$charger->getController('Scrolls');
$charger->getController('Keys');

//template
require_once 'template/Template.php';

try {
	if (!empty($_GET['url'])) {

		$url = $_GET['url'];
		
		switch ($url) {
			case 'users-home':
				$usersHome = new UsersController();
				$usersHome->getHome($database);
			break;

			case 'create-user':
				$createUser = new UsersController();
				$createUser->create($database);
			break;

			case 'disconnect':
				$disconnect = new UsersController();
				$disconnect->disconnect();
			break;

			case 'create-master':
				$createMaster = new MastersController();
				$createMaster->create($database);
			break;

			case 'connect-master':
				$connectMaster = new MastersController();
				$connectMaster->connect($database);
			break;

			case 'create-player':
				$createPlayer = new PlayersController();
				$createPlayer->create($database);
			break;

			case 'connect-player':
				$connectPlayer = new PlayersController();
				$connectPlayer->connect($database);
			break;

			case 'masters-home':
				$mastersHome = new MastersController();
				$mastersHome->getHome($database);
			break;

			case 'players-home':
				$playersHome = new PlayersController();
				$playersHome->getHome($database);
			break;

			case 'use-user':
				$useUser = new UsersController();
				$useUser->return($database);
			break;

			case 'create-game':
				$createGame = new GamesController();
				$createGame->create($database);
			break;

			case 'use-game':
				$useGame = new GamesController();
				$useGame->connect($database);
			break;

			case 'games-home':
				$gamesHome = new GamesController();
				$gamesHome->getHome($database);
			break;

			case 'games-list':
				$gamesList = new GamesController();
				$gamesList->listAllGames($database);
			break;

			case 'create-character':
				$createCharacter = new CharactersController();
				$createCharacter->create($database);
			break;

			case 'use-character':
				$useCharacter = new CharactersController();
				$useCharacter->connect($database);
			break;

			case 'characters-home':
				$charactersHome = new CharactersController();
				$charactersHome->getHome($database);
			break;

			case 'create-character-infos':
				$createCharacterInfos = new CharactersInfosController();
				$createCharacterInfos->create($database);
			break;

			case 'create-character-stats':
				$createCharacterStats = new CharactersStatsController();
				$createCharacterStats->create($database);
			break;

			case 'create-character-abilities':
				$createCharactersAbilities = new CharactersAbilitiesController();
				$createCharactersAbilities->create($database);
			break;

			case 'create-character-skills':
				$createCharactersSkills = new CharactersSkillsController();
				$createCharactersSkills->create($database);
			break;

			case 'create-character-stuff':
				$createCharactersStuff = new CharactersStuffController();
				$createCharactersStuff->create($database);
			break;

			case 'add-item-to-backpack':
				$addItemToBackpack = new CharactersStuffController();
				$addItemToBackpack->addItemToBackpack($database);
			break;

			case 'create-boss':
				$createBoss = new BossController();
				$createBoss->create($database);
			break;

			case 'create-dungeons':
				$createDungeons = new DungeonsController();
				$createDungeons->create($database);
			break;

			case 'create-mobs':
				$createMobs = new MobsController();
				$createMobs->create($database);
			break;

			case 'create-villagers':
				$createVillagers = new VillagersController();
				$createVillagers->create($database);
			break;

			case 'create-villages':
				$createVillages = new VillagesController();
				$createVillages->create($database);
			break;

			case 'create-scrolls':
				$createScrolls = new ScrollsController();
				$createScrolls->create($database);
			break;

			case 'create-keys':
				$createKeys = new KeysController();
				$createKeys->create($database);
			break;

			case 'get-character-sheet':
				$getSheet = new CharactersController();
				$getSheet->getYourCharacterSheet($database);
			break;

			case 'get-character-skills':
				$getSkills = new CharactersSkillsController();
				$getSkills->getCharacterSkills($database);
			break;

			case 'get-character-items':
				$getItems = new CharactersStuffController();
				$getItems->getCharacterItems($database);
			break;

			case 'get-boss':
				$getBoss = new BossController();
				$getBoss->get($database);
			break;

			case 'get-dungeons':
				$getDungeons = new DungeonsController();
				$getDungeons->get($database);
			break;

			case 'get-mobs':
				$getMobs = new MobsController();
				$getMobs->get($database);
			break;

			case 'get-keys':
				$getKeys = new KeysController();
				$getKeys->get($database);
			break;

			case 'get-scrolls':
				$getScrolls = new ScrollsController();
				$getScrolls->get($database);
			break;

			case 'get-villagers':
				$getVillagers = new VillagersController();
				$getVillagers->get($database);
			break;

			case 'get-villages':
				$getVillages = new VillagesController();
				$getVillages->get($database);
			break;

			case 'get-all-characters':
				$getAllCharacters = new CharactersController();
				$getAllCharacters->getAllCharacters($database);
			break;

			case 'get-one-character':
				$getOneCharacter = new CharactersController();
				$getOneCharacter->getOneCharacterSheet($database);
			break;

			case 'level-up':
				$levelUp = new CharactersStatsController();
				$levelUp->levelUp($database);
			break;

			case 'update-character-stats':
				$updateStats = new CharactersStatsController();
				$updateStats->updateStats($database);
			break;

			case 'increase-character-health':
				$increaseHealth = new CharactersStatsController();
				$increaseHealth->increaseHealth($database);
			break;

			case 'reduce-character-health':
				$reduceHealth = new CharactersStatsController();
				$reduceHealth->reduceHealth($database);
			break;

			case 'increase-character-energy':
				$increaseEnergy = new CharactersStatsController();
				$increaseEnergy->increaseEnergy($database);
			break;

			case 'reduce-character-energy':
				$reduceEnergy = new CharactersStatsController();
				$reduceEnergy->reduceEnergy($database);
			break;

			case 'update-character-skill':
				$updateSkill = new CharactersSkillsController();
				$updateSkill->update($database);
			break;

			case 'update-character-weapon':
				$updateWeapon = new CharactersStuffController();
				$updateWeapon->updateWeapon($database);
			break;

			case 'update-character-armor':
				$updateArmor = new CharactersStuffController();
				$updateArmor->updateArmor($database);
			break;

			case 'update-character-backpack':
				$updateBackpack = new CharactersStuffController();
				$updateBackpack->updateBackpack($database);
			break;

			case 'update-character-item':
				$updateItem = new CharactersStuffController();
				$updateItem->updateCharacterItem($database);
			break;

			case 'delete-character-item':
				$deleteItem = new CharactersStuffController();
				$deleteItem->deleteCharacterItem($database);
			break;

			default:
				throw new PageNotFoundException('Page not found !');
		}
	} else {
		$connection = new UsersController();
		$connection->connect($database);
	}
}

catch (PageNotFoundException $e) {
	$title = 'Error : Page not found !';

	catchException($e, $title);
}

catch (InvalidFormException $e) {
	$title = 'Error : Invalid Form !';

	catchException($e, $title);
}

catch (InvalidParameterException $e) {
	$title = 'Error : Invalid Parameter !';

	catchException($e, $title);
}

catch (AccessDeniedException $e) {
	$title = 'Error : Acces denied !';

	catchException($e, $title);
}

catch (UserException $e) {
	$title = 'Error : User error !';

	catchException($e, $title);
}

catch (PDOException $e) {
	$title = 'Error : PDO error !';

	catchException($e, $title);
}