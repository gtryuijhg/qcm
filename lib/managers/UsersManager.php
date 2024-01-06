<?php

Interface UsersManager
{
	public function addUser($id, $name, $hashLogin, $hashPassword, $status);

	public function getUserStatus($name);

	public function switchStatusAsUser($name, $status);

	public function switchStatusAsMaster($name, $status);

	public function switchStatusAsPlayer($name, $status);

	public function searchUserInBase($name);

	public function searchLoginInBase($hashLogin);

	public function searchUserAndPassword($userName, $password);

	public function userConnection($login, $password);
}