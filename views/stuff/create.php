<?php ob_start(); ?>

<h2>Create <?= $parameters['character']; ?>'s stuff :</h2>

<form method="post" action="/jdr/create-character-stuff">
	<div class="form-group">
		<label for="armor">Armor :</label>
		<input type="text" name="armor" id="armor" class="form-control">
	</div>

	<div class="form-group">
		<label for="weapon">Weapon :</label>
		<input type="text" name="weapon" id="weapon" class="form-control">
	</div>

	<div class="form-group">
		<label for="backpackSlots">Backpack Slots :</label>
		<input type="number" name="backpackSlots" id="backpackSlots" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Stuff</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/characters-home">Return at characters home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);