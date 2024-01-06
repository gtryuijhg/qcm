<?php ob_start(); ?>

<h2>Update <?= $parameters['character'] ?>'s armor :</h2>

<form method="post" action="/jdr/update-character-armor">
	<div class="form-group">
		<label for="armor">Armor :</label>
		<input type="text" name="armor" id="armor" value="<?= $parameters['armor']; ?>" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Armor</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/get-character-sheet">Return at <?= $parameters['character'] ?>'s stats sheet</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);