<?php

interface PlayersManager
{
	public function getPlayerInBase($playerName);

	public function addPlayer($id, $playerName, $gameName, $userName);

	public function takeGameInBase($playerName);

	public function takePlayerInBase($playerName, $gameName, $userName);

	public function getAllPlayers($gameName);

	public function getPlayerGame($playerName);
}