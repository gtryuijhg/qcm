<?php ob_start(); ?>

<h2>Connect a master :</h2>

<form method="post" action="/jdr/connect-master">
	<div class="form-group">
		<label for="masterName">Master Name :</label>
		<input type="text" name="masterName" id="masterName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Connect Master</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p>Return to users home by clicking <a href="/jdr/users-home">here</a> !</p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);