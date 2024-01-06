<?php

require_once 'PlayersValidator.php';

class PlayersValidatorImpl implements PlayersValidator
{
	public function isPlayerNameAlreadyTaken($playerName, $playerInBase):string
	{
		if (strtolower($playerName) === strtolower($playerInBase['player_name'])) {
			throw new UserException('This player name is already taken !');
		} else {
			return $playerName;
		}
	}

	public function isPlayerNameValid($playerName):string
	{
		if (strlen($playerName) > 20) {
			throw new InvalidParameterException('Your player name is too long !');
		} else if (preg_match('#[0-9]#', $playerName)) {
			throw new InvalidParameterException('Your player name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9]#', $playerName)) {
			throw new InvalidParameterException('Your player name cannot contain a special character !');
		} else {
			return $playerName;
		} 
	}

	public function isPlayerNameExists($playerName, $playerInBase):string
	{
		if (strtolower($playerName) === strtolower($playerInBase['player_name'])) {
			$_SESSION['playerName'] = $playerName;
			return $playerName;
		} else {
			throw new UserException('Player not found !');
		}
	}

	public function isGoodGame($gameName, $gameInBase):string
	{
		if (strtolower($gameName) === strtolower($gameInBase['game_name'])) {
			return $gameName;
		} else {
			throw new UserException('This character is in an other game !');
		}
	}
}