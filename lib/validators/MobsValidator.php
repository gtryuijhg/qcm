<?php

interface MobsValidator
{
	public function isMobNameValid($mobName):string;

	public function isNewMobNameValid($newMobName):string;

	public function isMobHealthValid($health):int;

	public function isMobLevelValid($level):int;

	public function isMobLocationValid($location):string;
}