<?php ob_start(); ?>

<h2>Connect a user :</h2>

<form method="post" action="/jdr/">
	<div class="form-group">
		<label for="userLogin">Login :</label>
		<input type="text" name="userLogin" id="userLogin" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Connect User</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p>If you have not your own user, you can create one by clicking <a href="/jdr/create-user">here</a> !</p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);