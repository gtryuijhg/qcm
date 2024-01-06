<?php ob_start(); ?>

<h2>Reduce <?= $parameters['character']; ?>'s health :</h2>

<form method="post" action="/jdr/reduce-character-health">
	<div class="form-group">
		<label for="pointsNumber">Points Number :</label>
		<input type="number" name="pointsNumber" id="pointsNumber" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Reduce Health</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/get-character-sheet">Return at <?= $parameters['character'] ?>'s stats sheet</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);