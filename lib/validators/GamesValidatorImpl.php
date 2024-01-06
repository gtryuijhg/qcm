<?php

require_once 'GamesValidator.php';

class GamesValidatorImpl implements GamesValidator
{
	public function checkGameNameLength($game):string
	{
		if (strlen($game) > 20) {
			throw new InvalidParameterException('Your game name is too long !');
		} else {
			return $game;
		}
	}

	public function isGameNameAlreadyTaken($gameName, $gameInBase):string
	{
		if (strtolower($gameName) === strtolower($gameInBase['game_name'])) {
			throw new UserException('This game name is already taken !');
		} else {
			return $gameName;
		}
	}

	public function isGameNameExists($gameName, $gameInBase):string
	{
		if (strtolower($gameName) === strtolower($gameInBase['game_name'])) {
			$gameName = $gameInBase['game_name'];
			return $gameName;
		} else {
			throw new UserException('Game name not found !');
		}
	}

	public function validatePlayersNumber($oldPlayersNumber):string
	{
		if ($oldPlayersNumber['players_number'] > '4') {
			throw new UserProfileException('This game have reach his maximun players number !');
		} else {
			return $oldPlayersNumber;
		}
	}
}