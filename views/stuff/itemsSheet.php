<?php ob_start(); ?>

<h2>Backpack :</h2>

<?php 
	foreach ($parameters['item'] as $item) {
?>
	<p>Item : <?= htmlspecialchars($item['item_name']); ?></p>
	<p>Item Slots : <?= htmlspecialchars($item['item_slots']); ?></p>
<?php			
	}	
?>

<h2>Update <?= $parameters['character']; ?>'s items :</h2>

<form method="post" action="/jdr/get-character-items">
	<div class="form-group">
		<label for="itemName">Item Name :</label>
		<input type="text" name="itemName" id="itemName" class="form-control">
	</div>

	<div class="form-group">
		<label for="newItemName">New Item Name :</label>
		<input type="text" name="newItemName" id="newItemName" class="form-control">
	</div>

	<div class="form-group">
		<label for="itemSlots">Item Slots :</label>
		<input type="number" name="itemSlots" id="itemSlots" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Update Item</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<h2>Delete <?= $parameters['character']; ?>'s items :</h2>

<form method="post" action="/jdr/get-character-items">
	<div class="form-group">
		<label for="itemName">Item Name :</label>
		<input type="text" name="itemName" id="itemName" class="form-control">
	</div>

	<div class="form-group">
		<label for="userPassword">User Password :</label>
		<input type="password" name="userPassword" id="userPassword" class="form-control">
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">Delete Item</button>
	</div>
	
	<input type="hidden" name="token" id="token" value="<?= $parameters['token']; ?>" />
</form>

<p><a href="/jdr/characters-home">Return at character's home</a></p>

<?php	

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);