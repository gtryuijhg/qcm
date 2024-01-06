<?php ob_start(); ?>

<h2>Choose an action !</h2>
<p>Create a master : click <a href="/jdr/create-master">here</a></p>
<p>Connect a master : click <a href="/jdr/connect-master">here</a></p>
<p>Create a player : click <a href="/jdr/create-player">here</a></p>
<p>Connect a player : click <a href="/jdr/connect-player">here</a></p>

<p>As a user, you can have several masters or players.</p>

<p><a href="/jdr/disconnect">Disconnect</a></p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);