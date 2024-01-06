<?php ob_start(); ?>

<h2>List of the games :</h2>

<?php
	foreach ($parameters['gamesList'] as $game) {
		?>
			<p>Game : <?= $game['game_name']; ?>, Master : <?= $game['master_name']; ?>,
				<?php if ($game['players_number'] !== null) { ?>
					Players number : <?= $game['players_number']; ?>
				<?php } else { ?>
					Players number : 0
				<?php } ?>
			</p>
		<?php
	}
?>

<p>Return to the player creation page by clicking <a href="/jdr/create-player">here</a> !</p>

<?php

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);