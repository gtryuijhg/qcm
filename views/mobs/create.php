<?php ob_start(); ?>

<h2>Create <?= $parameters['game']; ?>'s mobs :</h2>

<form method="post" action="/jdr/create-mobs">
	<div class="form-group">
		<label for="mobName">Mob Name :</label>
		<input type="text" name="mobName" id="mobName" class="form-control">
	</div>

	<div class="form-group">
		<label for="mobHealth">Health :</label>
		<input type="number" name="mobHealth" id="mobHealth" class="form-control">
	</div>

	<div class="form-group">
		<label for="mobLevel">Level :</label>
		<input type="number" name="mobLevel" id="mobLevel" class="form-control">
	</div>

	<div class="form-group">
		<label for="mobLocation">Location :</label>
		<input type="text" name="mobLocation" id="mobLocation" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Mob</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);