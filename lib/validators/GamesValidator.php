<?php

Interface GamesValidator
{
	public function checkGameNameLength($game):string;

	public function isGameNameAlreadyTaken($gameName, $gameInBase):string;

	public function isGameNameExists($gameName, $gameInBase):string;

	public function validatePlayersNumber($oldPlayersNumber):string;
}