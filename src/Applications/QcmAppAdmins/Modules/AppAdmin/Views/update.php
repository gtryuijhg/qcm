<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $appAdminUpdateAction; ?>">
	<?= $form; ?>
	
	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p><a href="<?= $appAdminHomePath; ?>">Retour</a></p>