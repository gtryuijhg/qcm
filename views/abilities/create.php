<?php ob_start(); ?>

<h2>Create <?= $parameters['character']; ?>'s abilities :</h2>

<form method="post" action="/jdr/create-character-abilities">
	<div class="form-group">
		<label for="physics">Physics :</label>
		<input type="number" name="physics" id="physics" class="form-control">
	</div>

	<div class="form-group">
		<label for="social">Social :</label>
		<input type="number" name="social" id="social" class="form-control">
	</div>

	<div class="form-group">
		<label for="mental">Mental :</label>
		<input type="number" name="mental" id="mental" class="form-control">
	</div>

	<div class="form-group">
		<label for="physicsAbility">Physics Ability :</label>
		<input type="text" name="physicsAbility" id="physicsAbility" class="form-control">
	</div>

	<div class="form-group">
		<label for="socialAbility">Social Ability :</label>
		<input type="text" name="socialAbility" id="socialAbility" class="form-control">
	</div>

	<div class="form-group">
		<label for="mentalAbility">Mental Ability :</label>
		<input type="text" name="mentalAbility" id="mentalAbility" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Abilities</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/characters-home">Return at characters home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);