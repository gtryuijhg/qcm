<?php ob_start(); ?>

<h2>Choose a game :</h2>

<form method="post" action="/jdr/use-game">
	<div class="form-group">
		<label for="gameName">Game Name :</label>
		<input type="text" name="gameName" id="gameName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Use Game</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p>Return to masters home by clicking <a href="/jdr/masters-home">here</a> !</p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);