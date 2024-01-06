<?php ob_start(); ?>

<h2>Use a character :</h2>

<form method="post" action="/jdr/use-character">
	<div class="form-group">
		<label for="characterName">Character Name :</label>
		<input type="text" name="characterName" id="characterName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Use Character</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/players-home">Return at players home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);