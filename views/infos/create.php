<?php ob_start(); ?>

<h2>Create <?= $parameters['character']; ?>'s infos :</h2>

<form method="post" action="/jdr/create-character-infos">
	<div class="form-group">
		<label for="characterClass">Class :</label>
		<input type="text" name="characterClass" id="characterClass" class="form-control">
	</div>

	<div class="form-group">
		<label for="particularity">Particularity :</label>
		<input type="text" name="particularity" id="particularity" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Infos</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/characters-home">Return at characters home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);