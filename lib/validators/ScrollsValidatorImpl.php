<?php

require_once 'ScrollsValidator.php';

class ScrollsValidatorImpl implements ScrollsValidator
{
	public function isScrollNameValid($scrollName):string
	{
		if (preg_match('#[0-9]#', $scrollName)) {
			throw new InvalidParameterException('Scroll name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9\s]#', $scrollName)) {
			throw new InvalidParameterException('Scroll name cannot contain a special character !');
		} else {
			return $scrollName;
		}
	}

	public function isNewScrollNameValid($newScrollName):string
	{
		if (preg_match('#[0-9]#', $newScrollName)) {
			throw new InvalidParameterException('Scroll name cannot contain a number !');
		} else if (preg_match('#[^A-Za-z0-9\s]#', $newScrollName)) {
			throw new InvalidParameterException('Scroll name cannot contain a special character !');
		} else {
			return $newScrollName;
		}
	}
}