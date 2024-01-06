<?php ob_start(); ?>

<h2>Create <?= $parameters['game']; ?>'s villages :</h2>

<form method="post" action="/jdr/create-villages">
	<div class="form-group">
		<label for="villageName">Village Name :</label>
		<input type="text" name="villageName" id="villageName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Village</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);