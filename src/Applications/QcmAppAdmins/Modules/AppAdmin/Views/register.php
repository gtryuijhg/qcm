<h1><?= $title; ?></h1>

<form method="<?= $formMethod; ?>" action="<?= $appAdminRegisterAction; ?>">
	<?= $form; ?>
	
	<?= $token; ?>
	
	<?= $button; ?>
</form>

<p>Vous avez déjà un compte ? Connectez vous <a href="<?= $appAdminSigninPath; ?>">ici</a></p>