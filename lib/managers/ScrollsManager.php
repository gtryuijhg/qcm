<?php

interface ScrollsManager
{
	public function addScroll($id, $scrollName, $gameName);

	public function getScrollsList($gameName);

	public function updateScroll($scrollName, $newScrollName, $gameName);

	public function deleteScroll($gameName, $scrollName);
}