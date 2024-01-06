<?php

Interface GamesManager
{
	public function addGame($id, $gameName, $master);

	public function checkGameNameWithMasterInBase($gameName, $masterName);

	public function getListOfGames();

	public function getPlayersNumberByGame($gameName, $oldPlayersNumber);

	public function getGameNameInBase($gameName);

	public function setPlayerNumberInGame($gameName, $playersNumber);
}