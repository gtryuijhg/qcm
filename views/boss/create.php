<?php ob_start(); ?>

<h2>Create <?= $parameters['game']; ?>'s boss :</h2>

<form method="post" action="/jdr/create-boss">
	<div class="form-group">
		<label for="bossName">Boss Name :</label>
		<input type="text" name="bossName" id="bossName" class="form-control">
	</div>

	<div class="form-group">
		<label for="bossHealth">Health :</label>
		<input type="number" name="bossHealth" id="bossHealth" class="form-control">
	</div>

	<div class="form-group">
		<label for="bossLevel">Level :</label>
		<input type="number" name="bossLevel" id="bossLevel" class="form-control">
	</div>

	<div class="form-group">
		<label for="bossLocation">Location :</label>
		<input type="text" name="bossLocation" id="bossLocation" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Boss</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);