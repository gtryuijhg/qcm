<?php ob_start();

	foreach ($parameters['character'] as $character) {
?>
		
	<p>Character : <?= $character['character_name']; ?></p>

<?php	
	}
?>

<p>Choose a character</p>

<form method="post" action="/jdr/get-one-character"> 
	<div class="form-group">
		<label for="characterName">Character Name :</label>
		<input type="text" name="characterName" id="characterName" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Choose a Character</button>
	</div>

	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/games-home">Return at games home</a></p>

<?php	

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);

