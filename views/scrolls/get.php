<?php ob_start();

foreach ($parameters['scrollsList'] as $scroll) {
	?>
		<p>
			Scroll : <?= $scroll['scroll_name']; ?>
		</p>
		
	<?php
}
?>

<h2>Update <?= $parameters['game']; ?>'s scroll</h2>

<form method="post" action="/jdr/get-scrolls">
	<div class="form-group">
		<label for="scrollName">Scroll Name :</label>
		<input type="text" name="scrollName" id="scrollName" class="form-control">
	</div>

	<div class="form-group">
		<label for="newScrollName">New Scroll Name :</label>
		<input type="text" name="newScrollName" id="newScrollName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Scroll</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<h2>Delete <?= $parameters['game']; ?>'s scroll</h2>

<form method="post" action="/jdr/get-scrolls">
	<div class="form-group">
		<label for="scrollName">Scroll Name :</label>
		<input type="text" name="scrollName" id="scrollName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Delete Scroll</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);