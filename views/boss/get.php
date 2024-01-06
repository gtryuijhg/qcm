<?php ob_start(); 

foreach ($parameters['bossList'] as $boss) {
	?>
		<p>
			Boss : <?= $boss['boss_name']; ?></br>
			Health : <?= $boss['health']; ?></br>
			Level : <?= $boss['level']; ?></br>
			Location : <?= $boss['location']; ?>
		</p>
		
	<?php
}
?>

<h2>Update <?= $parameters['game']; ?>'s boss</h2>

<form method="post" action="/jdr/get-boss">
	<div class="form-group">
		<label for="bossName">Boss Name :</label>
		<input type="text" name="bossName" id="bossName" class="form-control">
	</div>

	<div class="form-group">
		<label for="newBossName">New Boss Name :</label>
		<input type="text" name="newBossName" id="newBossName" class="form-control">
	</div>

	<div class="form-group">
		<label for="bossHealth">Health :</label>
		<input type="number" name="bossHealth" id="bossHealth" class="form-control">
	</div>

	<div class="form-group">
		<label for="bossLevel">Level :</label>
		<input type="number" name="bossLevel" id="bossLevel" class="form-control">
	</div>

	<div class="form-group">
		<label for="bossLocation">Location :</label>
		<input type="text" name="bossLocation" id="bossLocation" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Boss</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<h2>Delete <?= $parameters['game']; ?>'s boss</h2>

<form method="post" action="/jdr/get-boss">
	<div class="form-group">
		<label for="bossName">Boss Name :</label>
		<input type="text" name="bossName" id="bossName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Delete Boss</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);