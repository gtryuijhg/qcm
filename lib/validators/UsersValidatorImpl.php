<?php

require_once 'UsersValidator.php';

class UsersValidatorImpl implements UsersValidator
{
	public function isConnected($userName):string
	{
		if (!empty($_SESSION['userName'])) {
			$userName = htmlspecialchars($_SESSION['userName']);

			return $userName;
		} else {
			throw new UserException('You are not connected !');
		}
	}

	public function isUserNameValid($name):string
	{
		if (strlen($name) > 20) {
			throw new InvalidParameterException('Your user name is too long !');
		} else if (preg_match('#[0-9]#', $name)) {
			throw new InvalidParameterException('Your user name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9éèöôïî]#', $name)) {
			throw new InvalidParameterException('Your user name cannot contain a special character !');
		} else {
			return $name;
		}
	}

	public function isUserLoginValid($login):string
	{
		if (strlen($login) < 8) {
			throw new InvalidParameterException('Your login is too short !');
		} else if (strlen($login > 20)) {
			throw new InvalidParameterException('Your login is too long !');			
		} else {
			return $login;
		}
	}

	public function isUserPasswordValid($password):string
	{
		if (strlen($password) < 8) {
			throw new InvalidParameterException('Your password is too short !');
		} else if (strlen($password > 20)) {
			throw new InvalidParameterException('Your password is too long !');			
		} else if (!preg_match('#[0-9]#', $password)) {
			throw new InvalidParameterException('Your password must contain at least one number !');
		} else if (!preg_match('#[^A-Za-z0-9]#', $password)) {
			throw new InvalidParameterException('Your password must contain at least one special character !');
		} else {
			return $password;
		}
	}

	public function isSameLogins($login, $connectUser):string
	{
		if ($login === $connectUser['user_login']) {
			return $login;
		} else {
			throw new InvalidParameterException('Logins are differents or user doesn\'t exist !');
		}
	}

	public function isSamePasswords($password, $connectUser):string
	{
		if ($password === $connectUser['user_password']) {
			return $password;
		} else {
			throw new InvalidParameterException('Passwords are differents !');
		}
	}

	public function isYourUserPassword($password, $searchUser):string
	{
		if ($password === $searchUser['user_password']) {
			return $password;
		} else {
			throw new InvalidParameterException('This is not your user password !');
		}
	}

	public function isUserStatus($userStatus, $statusExpected):string
	{
		if ($userStatus === $statusExpected) {
			return $userStatus;
		} else {
			throw new AccessDeniedException('You are not '.$statusExpected.', acces denied !');
		}
	}

	public function isUserAlreadyTaken($name, $userInBase):string
	{
		if (strtolower($name) === strtolower($userInBase['user_name'])) {
			throw new UserException('This user name is already taken !');
		} else {
			return $name;
		}
	}

	public function isLoginAlreadyTaken($hashLogin, $loginInBase):string
	{
		if (strtolower($hashLogin) === strtolower($loginInBase['user_login'])) {
			throw new UserException('This login is already taken !');
		} else {
			return $hashLogin;
		}
	}
}