<?php ob_start();

foreach ($parameters['dungeonsList'] as $dungeon) {
	?>
		<p>
			Dungeon : <?= $dungeon['dungeon_name']; ?></br>
			Level : <?= $dungeon['level']; ?>
		</p>
		
	<?php
}
?>

<h2>Update <?= $parameters['game']; ?>'s dungeon</h2>

<form method="post" action="/jdr/get-dungeons">
	<div class="form-group">
		<label for="dungeonName">Dungeon Name :</label>
		<input type="text" name="dungeonName" id="dungeonName" class="form-control">
	</div>

	<div class="form-group">
		<label for="newDungeonName">New Dungeon Name :</label>
		<input type="text" name="newDungeonName" id="newDungeonName" class="form-control">
	</div>

	<div class="form-group">
		<label for="dungeonLevel">Level :</label>
		<input type="number" name="dungeonLevel" id="dungeonLevel" class="form-control">
	</div>

	<div class="form-group">
		<button class="btn btn-primary">Update Dungeon</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<h2>Delete <?= $parameters['game']; ?>'s dungeon</h2>

<form method="post" action="/jdr/get-dungeons">
	<div class="form-group">
		<label for="dungeonName">Dungeon Name :</label>
		<input type="text" name="dungeonName" id="dungeonName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Delete Dungeon</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);