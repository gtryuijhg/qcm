<?php ob_start(); ?>

<h2>Level Up <?= $parameters['character']; ?> :</h2>

<form method="post" action="/jdr/level-up">
	<div class="form-group">
		<label for="addHealth">Add Health :</label>
		<input type="number" name="addHealth" id="addHealth" class="form-control">
	</div>

	<div class="form-group">
		<label for="addEnergy">Add Energy</label>
		<input type="number" name="addEnergy" id="addEnergy" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Level Up</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/get-character-sheet">Return at <?= $parameters['character'] ?>'s stats sheet</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);