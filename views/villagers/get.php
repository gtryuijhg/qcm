<?php ob_start();

foreach ($parameters['villagersList'] as $villager) {
	?>
		<p>
			Villager : <?= $villager['villager_name']; ?></br>
			Job : <?= $villager['villager_job']; ?></br>
			Village : <?= $villager['villager_village']; ?>
		</p>
		
	<?php
}
?>

<h2>Update <?= $parameters['game']; ?>'s villager</h2>

<form method="post" action="/jdr/get-villagers">
	<div class="form-group">
		<label for="villagerName">Villager Name :</label>
		<input type="text" name="villagerName" id="villagerName" class="form-control">
	</div>

	<div class="form-group">
		<label for="newVillagerName">New Villager Name :</label>
		<input type="text" name="newVillagerName" id="newVillagerName" class="form-control">
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
		<button type="submit" class="btn btn-primary">Update Villager</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<h2>Delete <?= $parameters['game']; ?>'s villager</h2>

<form method="post" action="/jdr/get-villagers">
	<div class="form-group">
		<label for="villagerName">Villager Name :</label>
		<input type="text" name="villagerName" id="villagerName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Delete Villager</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);