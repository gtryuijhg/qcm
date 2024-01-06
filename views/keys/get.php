<?php ob_start();

foreach ($parameters['keysList'] as $key) {
	?>
		<p>
			Key : <?= $key['key_name']; ?>
		</p>
		
	<?php
}
?>

<h2>Update <?= $parameters['game']; ?>'s key</h2>

<form method="post" action="/jdr/get-keys">
	<div class="form-group">
		<label for="keyName">Key Name :</label>
		<input type="text" name="keyName" id="keyName" class="form-control">
	</div>

	<div class="form-group">
		<label for="newKeyName">New Key Name :</label>
		<input type="text" name="newKeyName" id="newKeyName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Key</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<h2>Delete <?= $parameters['game']; ?>'s key</h2>

<form method="post" action="/jdr/get-keys">
	<div class="form-group">
		<label for="keyName">Key Name :</label>
		<input type="text" name="keyName" id="keyName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Delete Key</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);