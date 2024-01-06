<?php ob_start(); ?>

<h2>Create <?= $parameters['game']; ?>'s dungeons :</h2>

<form method="post" action="/jdr/create-dungeons">
	<div class="form-group">
		<label for="dungeonName">Dungeon Name :</label>
		<input type="text" name="dungeonName" id="dungeonName" class="form-control">
	</div>

	<div class="form-group">
		<label for="dungeonLevel">Level :</label>
		<input type="number" name="dungeonLevel" id="dungeonLevel" class="form-control">
	</div>

	<div class="form-group">
		<button class="btn btn-primary">Create Dungeon</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);