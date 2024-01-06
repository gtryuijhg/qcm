<?php

interface FormsValidator
{
	public function isMissingFormToken():string;

	public function isMissingSessionToken():string;

	public function isSameTokens():string;

	public function isGoodForm($form):string;
}