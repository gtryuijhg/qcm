<?php

interface UsersValidator
{
	public function isConnected($userName):string;

	public function isUserNameValid($name):string;

	public function isUserLoginValid($login):string;

	public function isUserPasswordValid($password):string;

	public function isSameLogins($login, $connectUser):string;

	public function isSamePasswords($password, $connectUser):string;

	public function isYourUserPassword($password, $searchUser):string;

	public function isUserStatus($userStatus, $statusExpected):string;

	public function isUserAlreadyTaken($name, $userInBase):string;

	public function isLoginAlreadyTaken($hashLogin, $loginInBase):string;
}