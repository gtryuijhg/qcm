<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $answerUpdateAction; ?>">
	<?= $form; ?>
	
	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $answerListPath; ?>">Retour</a></p>