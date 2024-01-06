<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $appAdminSigninAction; ?>">
	<?= $form; ?>
	
	
	<?= $token; ?>
	
	<?= $button; ?>	
</form>

<p>Vous n'avez pas de compte ? Inscrivez vous <a href="<?= $appAdminRegisterPath; ?>">ici</a></p>