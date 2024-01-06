<?php ob_start(); ?>

<p>You are using <?= $parameters['character']; ?></p>

<h2>What do you want to do ?</h2>

<p>Create <?= $parameters['character']; ?>'s infos : click <a href="/jdr/create-character-infos"> here</a></p>
<p>Create <?= $parameters['character']; ?>'s stats : click <a href="/jdr/create-character-stats"> here</a></p>
<p>Create <?= $parameters['character']; ?>'s abilities : click <a href="/jdr/create-character-abilities"> here</a></p>
<p>Create <?= $parameters['character']; ?>'s skills : click <a href="/jdr/create-character-skills"> here</a></p>
<p>Create <?= $parameters['character']; ?>'s stuff : click <a href="/jdr/create-character-stuff"> here</a></p>
<p>Add item to <?= $parameters['character']; ?>'s backpack : click <a href="/jdr/add-item-to-backpack"> here</a></p>

<p>Check <?= $parameters['character']; ?>'s sheet ? click <a href="/jdr/get-character-sheet"> here</a></p>
<p>Check <?= $parameters['character']; ?>'s skills ? click <a href="/jdr/get-character-skills"> here</a></p>
<p>Check <?= $parameters['character']; ?>'s items ? click <a href="/jdr/get-character-items"> here</a></p>

<p><a href="/jdr/players-home">Return at players home</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);