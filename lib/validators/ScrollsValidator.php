<?php

interface ScrollsValidator
{
	public function isScrollNameValid($scrollName):string;

	public function isNewScrollNameValid($newScrollName):string;
}