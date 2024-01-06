<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $answerDeleteAction; ?>">
	<?= $form; ?>

	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $answerListPath; ?>">Retour</a></p>