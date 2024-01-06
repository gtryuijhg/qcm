<?php ob_start(); ?>

<h2>Create a player :</h2>

<form method="post" action="/jdr/create-player">
	<div class="form-group">
		<label for="playerName">Player Name :</label>
		<input type="text" name="playerName" id="playerName" class="form-control">
	</div>

	<div class="form-group">
		<label for="gameName">Game Name :</label>
		<input type="text" name="gameName" id="gameName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create Player</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p>Get all games names by clicking <a href="/jdr/games-list">here</a></p>

<p>Return to users home by clicking <a href="/jdr/users-home">here</a> !</p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);