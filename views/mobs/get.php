<?php ob_start();

foreach ($parameters['mobsList'] as $mob) {
	?>
		<p>
			Mob : <?= $mob['mob_name']; ?></br>
			Health : <?= $mob['health']; ?></br>
			Level : <?= $mob['level']; ?></br>
			Location : <?= $mob['location']; ?>
		</p>
		
	<?php
}
?>

<h2>Update <?= $parameters['game']; ?>'s mob</h2>

<form method="post" action="/jdr/get-mobs">
	<div class="form-group">
		<label for="mobName">Mob Name :</label>
		<input type="text" name="mobName" id="mobName" class="form-control">
	</div>

	<div class="form-group">
		<label for="newMobName">New Mob Name :</label>
		<input type="text" name="newMobName" id="newMobName" class="form-control">
	</div>

	<div class="form-group">
		<label for="mobHealth">Health :</label>
		<input type="number" name="mobHealth" id="mobHealth" class="form-control">
	</div>

	<div class="form-group">
		<label for="mobLevel">Level :</label>
		<input type="number" name="mobLevel" id="mobLevel" class="form-control">
	</div>

	<div class="form-group">
		<label for="mobLocation">Location :</label>
		<input type="text" name="mobLocation" id="mobLocation" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Mob</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<h2>Delete <?= $parameters['game']; ?>'s mob</h2>

<form method="post" action="/jdr/get-mobs">
	<div class="form-group">
		<label for="mobName">Mob Name :</label>
		<input type="text" name="mobName" id="mobName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Delete Mob</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);