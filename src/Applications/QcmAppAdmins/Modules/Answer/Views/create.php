<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $answerCreateAction; ?>">
	<?= $form; ?>
	
	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $questionListPath; ?>">Retour</a></p>