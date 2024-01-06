<?php ob_start(); ?>

<p>As a master, you can create and manage your own games.</p>

<p>Create a game : click <a href="/jdr/create-game">here</a></p>
<p>Choose a game : click <a href="/jdr/use-game">here</a></p>

<p><a href="/jdr/use-user">Return as user</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);