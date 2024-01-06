<?php ob_start(); ?>

<h2>Add item to <?= $parameters['character']; ?>'s backpack :</h2>

<form method="post" action="/jdr/add-item-to-backpack">
	<div class="form-group">
		<label for="itemName">Item Name :</label>
		<input type="text" name="itemName" id="itemName" class="form-control">
	</div>

	<div class="form-group">
		<label for="itemSlots">Item Slots :</label>
		<input type="number" name="itemSlots" id="itemSlots" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Add item to Backpack</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/characters-home">Return at characters home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);