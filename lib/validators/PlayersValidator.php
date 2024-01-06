<?php

interface PlayersValidator
{
	public function isPlayerNameAlreadyTaken($playerName, $playerInBase):string;

	public function isPlayerNameValid($playerName):string;

	public function isPlayerNameExists($playerName, $playerInBase):string;

	public function isGoodGame($gameName, $gameInBase):string;
}