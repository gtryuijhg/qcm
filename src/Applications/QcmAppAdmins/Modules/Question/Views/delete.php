<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $questionDeleteAction; ?>">
	<?= $form; ?>

	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $questionListPath; ?>">Retour</a></p>