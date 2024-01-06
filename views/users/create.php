<?php ob_start(); ?>

<h2>Create a user :</h2>	

<form method="post" action="/jdr/create-user">
	<div class="form-group">
		<label for="userName">Name :</label>
		<input type="text" name="userName" id="userName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userLogin">Login :</label>
		<input type="text" name="userLogin" id="userLogin" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Create User</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p>Return to connection by clicking <a href="/jdr/">here</a> !</p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);