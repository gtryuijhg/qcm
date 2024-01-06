<?php ob_start(); ?>

<h2>Create <?= $parameters['game']; ?>'s villagers :</h2>

<form method="post" action="/jdr/create-villagers">
	<div class="form-group">
		<label for="villagerName">Villager Name :</label>
		<input type="text" name="villagerName" id="villagerName" class="form-control">
	</div>

	<div class="form-group">
		<label for="villagerJob">Job :</label>
		<input type="text" name="villagerJob" id="villagerJob" class="form-control">
	</div>

	<div class="form-group">
		<label for="villagerVillage">Village :</label>
		<input type="text" name="villagerVillage" id="villagerVillage" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Villager</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);