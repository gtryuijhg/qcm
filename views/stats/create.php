<?php ob_start(); ?>

<h2>Create <?= $parameters['character']; ?>'s stats :</h2>

<form method="post" action="/jdr/create-character-stats">
	<div class="form-group">
		<label for="health">Health :</label>
		<input type="number" name="health" id="health" class="form-control">
	</div>

	<div class="form-group">
		<label for="energy">Energy :</label>
		<input type="number" name="energy" id="energy" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Stats</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/characters-home">Return at characters home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);