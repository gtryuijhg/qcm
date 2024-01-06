<?php ob_start(); ?>

<h2>What do you want to do ?</h2>

<div class="row">
	<div class="col-md-6">
		<h3>Create data ?</h3>
		<p>Create <?= $parameters['game']; ?> bosses : click <a href="/jdr/create-boss"> here</a></p>
		<p>Create <?= $parameters['game']; ?> dungeons : click <a href="/jdr/create-dungeons"> here</a></p>
		<p>Create <?= $parameters['game']; ?> mobs : click <a href="/jdr/create-mobs"> here</a></p>
		<p>Create <?= $parameters['game']; ?> villagers : click <a href="/jdr/create-villagers"> here</a></p>
		<p>Create <?= $parameters['game']; ?> villages : click <a href="/jdr/create-villages"> here</a></p>
		<p>Create <?= $parameters['game']; ?> scrolls : click <a href="/jdr/create-scrolls"> here</a></p>
		<p>Create <?= $parameters['game']; ?> keys : click <a href="/jdr/create-keys"> here</a></p>
	</div>

	<div class="col-md-6">
		<h3>Get data ?</h3>
		<p>Get all <?= $parameters['game']; ?> characters sheets : click <a href="/jdr/get-all-characters"> here</a></p>
		<p>Get <?= $parameters['game']; ?> bosses : click <a href="/jdr/get-boss"> here</a></p>
		<p>Get <?= $parameters['game']; ?> dungeons : click <a href="/jdr/get-dungeons"> here</a></p>
		<p>Get <?= $parameters['game']; ?> mobs : click <a href="/jdr/get-mobs"> here</a></p>
		<p>Get <?= $parameters['game']; ?> villagers : click <a href="/jdr/get-villagers"> here</a></p>
		<p>Get <?= $parameters['game']; ?> villages : click <a href="/jdr/get-villages"> here</a></p>
		<p>Get <?= $parameters['game']; ?> scrolls : click <a href="/jdr/get-scrolls"> here</a></p>
		<p>Get <?= $parameters['game']; ?> keys : click <a href="/jdr/get-keys"> here</a></p>
	</div>
</div>

<h2>Roll the dice :</h2>

<div>
	<label for="diceNumber">Dice number :</label>
	<input type="number" name="diceNumber" id="diceNumber">
</div>

<div>
	<button id="diceRoll">Roll the dice</button>
	<span id="diceScore"></span>
</div>

<p><a href="/jdr/masters-home">Return at masters home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);