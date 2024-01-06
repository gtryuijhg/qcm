<?php ob_start(); ?>

<h2>Update <?= $parameters['character'] ?>'s weapon :</h2>

<form method="post" action="/jdr/update-character-weapon">
	<div class="form-group">
		<label for="weapon">Weapon :</label>
		<input type="text" name="weapon" id="weapon" value="<?= $parameters['weapon']; ?>" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Weapon</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/get-character-sheet">Return at <?= $parameters['character'] ?>'s stats sheet</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);