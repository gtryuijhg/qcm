<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $appUserDeleteAction; ?>">
	<?= $form; ?>
	
	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $appUserListPath; ?>">Retour</a></p>