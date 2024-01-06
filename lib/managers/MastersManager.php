<?php

interface MastersManager
{
	public function addMaster($id, $masterName, $userName);

	public function checkMasterInBase($masterName, $userName);

	public function searchMasterInBase($masterName);
}