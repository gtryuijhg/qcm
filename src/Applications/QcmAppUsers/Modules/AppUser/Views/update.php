<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $appUserUpdateAction; ?>">
	<?= $form; ?>
	
	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $appUserHomePath; ?>">Retour</a></p>