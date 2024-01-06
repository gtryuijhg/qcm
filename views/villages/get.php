<?php ob_start();

foreach ($parameters['villagesList'] as $village) {
	?>
		<p>
			Village : <?= $village['village_name']; ?>
		</p>
		
	<?php
}
?>

<h2>Update <?= $parameters['game']; ?>'s village</h2>

<form method="post" action="/jdr/get-villages">
	<div class="form-group">
		<label for="villageName">Village Name :</label>
		<input type="text" name="villageName" id="villageName" class="form-control">
	</div>

	<div class="form-group">
		<label for="newVillageName">New Village Name :</label>
		<input type="text" name="newVillageName" id="newVillageName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Village</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<h2>Delete <?= $parameters['game']; ?>'s village</h2>

<form method="post" action="/jdr/get-villages">
	<div class="form-group">
		<label for="villageName">Village Name :</label>
		<input type="text" name="villageName" id="villageName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Delete Village</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);