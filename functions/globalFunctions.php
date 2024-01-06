<?php

function catchException($e, $title)
{
	$errorMessage = $e->getMessage();

	$charger = new ClassCharger();
	$charger->getView('exceptions/exception', [
		'title' => $title,
		'errorMessage' => $errorMessage
	]);
}

function checkTokens()
{
	//we check if the form token is missing
	$validateFormToken = new FormsValidatorImpl();
	$validateFormToken->isMissingFormToken();

	//we check if the session token is missing
	$validateSessionToken = new FormsValidatorImpl();
	$validateSessionToken->isMissingSessionToken();

	//we check if they are same tokens
	$validateTokens = new FormsValidatorImpl();
	$validateTokens->isSameTokens();
}

function hashLogin($login)
{
	$length = strlen($login);

	$hash1 = hash("sha512", $login);

	$hash2 = hash("sha256", $login);

	$salt1 = sha1($hash1.$length.$login);

	$salt2 = md5($hash2.$length.$login);

	$login = strtoupper(strrev($salt1.$length.$salt2));

	return $login;
}

function hashPassword($password)
{
	$length = strlen($password);

	$hash1 = hash("sha256", $password.$length);

	$hash2 = hash("sha512", $length.$password);

	$salt1 = sha1($hash2.$password.$length);

	$salt2 = md5($hash1.$length.$password);

	$password = strtoupper(strrev($salt1.$length.$salt2));

	return $password;
}

function redirect($page)
{
	header('Location:/jdr'.$page);
}