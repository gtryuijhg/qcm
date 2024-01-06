<?php

//we charge classes
require_once 'lib/charger/ClassCharger.php';
$charger = new ClassCharger();

$charger->getManager('CharactersSkills');
$charger->getValidator('CharactersSkills');

class CharactersSkillsController
{
	public function create($database)
	{
		if (!empty($_POST['skillName']) && !empty($_POST['skillDescription'])) {

			checkTokens();

			//we check if the request came from the good form
			$validateForm = new FormsValidatorImpl();
			$validateForm->isGoodForm('/create-character-skills');

			$id = 0;
			$characterName = htmlspecialchars($_SESSION['characterName']);
			$skillName = htmlspecialchars($_POST['skillName']);
			$skillDescription = htmlspecialchars($_POST['skillDescription']);

			// we validate skill name
			$isSkillNameValid = new CharactersSkillsValidatorImpl();
			$skillName = $isSkillNameValid->isSkillNameValid($skillName);

			// we add character skill
			$addSkill = new CharactersSkillsManagerImpl($database);
			$addSkill->addSkill($id, $characterName, $skillName, $skillDescription);

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

			$createCharactersSkillsToken = bin2hex(random_bytes(32));
			$_SESSION['token'] = $createCharactersSkillsToken;

			$title = 'Welcome to the skills creation page '.$userStatus.' '.$playerName.' !';

			$charger = new ClassCharger();
			$charger->getView('skills/create', [
				'title' => $title,
				'token' => $createCharactersSkillsToken,
				'character' => $characterName
			]);
		}
	}

	public function getCharacterSkills($database)
	{
		$userName = '';
		
		//we check if user is connected
		$isConnected = new UsersValidatorImpl();
		$userName = $isConnected->isConnected($userName);

		$playerName = htmlspecialchars($_SESSION['playerName']);
		$characterName = htmlspecialchars($_SESSION['characterName']);

		//we get user status
		$getUserStatus = new UsersManagerImpl($database);
		$userStatus = $getUserStatus->getUserStatus($userName);

		$isUserStatus = new UsersValidatorImpl();
		$userStatus = $isUserStatus->isUserStatus($userStatus, "player");

		//we get character skills
		$getAllCharacterSkills = new CharactersSkillsManagerImpl($database);
		$characterSkills = $getAllCharacterSkills->getAllCharacterSkills($characterName);

		$title = 'Welcome to '.$characterName.'\'s skills page '.$userStatus.' '.$playerName.' !';

		$charger = new ClassCharger();
		$charger->getView('skills/skillsSheet', [
			'title' => $title,
			'skill' => $characterSkills
		]);
	}
}