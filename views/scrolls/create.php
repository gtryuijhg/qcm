<?php ob_start(); ?>

<h2>Create <?= $parameters['game']; ?>'s scrolls :</h2>

<form method="post" action="/jdr/create-scrolls">
	<div class="form-group">
		<label for="scrollName">Scroll Name :</label>
		<input type="text" name="scrollName" id="scrollName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Scroll</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);