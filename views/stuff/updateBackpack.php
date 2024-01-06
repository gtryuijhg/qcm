<?php ob_start(); ?>

<h2>Update <?= $parameters['character'] ?>'s backpack :</h2>

<form method="post" action="/jdr/update-character-backpack">
	<div class="form-group">
		<label for="backpackSlots">Backpack Slots :</label>
		<input type="number" name="backpackSlots" id="backpackSlots" value="<?= $parameters['backpack']; ?>" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Backpack</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/get-character-sheet">Return at <?= $parameters['character'] ?>'s stats sheet</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);