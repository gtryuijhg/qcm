<?php ob_start(); ?>

<p>As a player, you can create and manage your own characters.</p>

<p>Create a character by clicking <a href="/jdr/create-character">here</a></p>

<p>Use one of your characters by clicking <a href="/jdr/use-character">here</a></p>

<p><a href="/jdr/use-user">Return as user</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);