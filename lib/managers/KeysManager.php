<?php

interface KeysManager
{
	public function addKey($id, $keyName, $gameName);

	public function getKeysList($gameName);

	public function updateKey($keyName, $newKeyName, $gameName);

	public function deleteKey($gameName, $keyName);
}