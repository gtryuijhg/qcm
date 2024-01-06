<?php ob_start(); ?>

<h2>Create <?= $parameters['character']; ?>'s skills :</h2>

<form method="post" action="/jdr/create-character-skills">
	<div class="form-group">
		<label for="skillName">Skill Name :</label>
		<input type="text" name="skillName" id="skillName" class="form-control">
	</div>

	<div class="form-group">
		<label for="skillDescription">Description :</label>
		<textarea name="skillDescription" id="skillDescription" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Skill</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/characters-home">Return at characters home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);