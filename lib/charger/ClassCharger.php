<?php

class ClassCharger
{
	public function getController($controller)
	{
		$controller = 'controllers/' . $controller . 'Controller.php';

		require_once $controller;
	}

	public function getManager($manager)
	{
		$manager = 'lib/managers/' . $manager . 'ManagerImpl.php';

		require_once $manager;
	}

	public function getValidator($validator)
	{
		$validator = 'lib/validators/' . $validator .'ValidatorImpl.php';

		require_once $validator;
	}

	public function getException($exception)
	{
		$exception = 'lib/exceptions/' . $exception .'Exception.php';

		require_once $exception;
	}

	public function getView($view, $parameters)
	{
		$view = 'views/' . $view . '.php';

        require_once $view;
	}
}