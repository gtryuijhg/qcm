<?php ob_start(); ?>

<h2>Create <?= $parameters['game']; ?>'s keys :</h2>

<form method="post" action="/jdr/create-keys">
	<div class="form-group">
		<label for="keyName">Key Name :</label>
		<input type="text" name="keyName" id="keyName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Key</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);