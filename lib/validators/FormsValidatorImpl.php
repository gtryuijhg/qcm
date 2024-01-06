<?php

require_once 'FormsValidator.php';

class FormsValidatorImpl implements FormsValidator
{
	public function isMissingFormToken():string
	{
		if (!empty($_POST['token'])) {
			return $_POST['token'];
		} else {
			throw new InvalidFormException('One or more token is missing !');
		}
	}

	public function isMissingSessionToken():string
	{
		if (!empty($_SESSION['token'])) {
			return $_SESSION['token'];
		} else {
			throw new InvalidFormException('One or more token is missing !');
		}
	}

	public function isSameTokens():string
	{
		if ($_SESSION['token'] === $_POST['token']) {
			return $_SESSION['token'];
		} else {
			throw new InvalidFormException('Tokens doesn\'t match !');
		}
	}

	public function isGoodForm($url):string
	{
		if ($_SERVER['HTTP_REFERER'] === 'http://localhost/jdr'.$url) {
			return $_SERVER['HTTP_REFERER'];
		} else {
			throw new InvalidFormException('You are not using the right form !');
		}
	}
}