<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $questionCreateAction; ?>">
	<?= $form; ?>
	
	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $appAdminHomePath; ?>">Retour</a></p>