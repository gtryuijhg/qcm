<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $questionUpdateAction; ?>">
	<?= $form; ?>
	
	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $questionListPath; ?>">Retour</a></p>