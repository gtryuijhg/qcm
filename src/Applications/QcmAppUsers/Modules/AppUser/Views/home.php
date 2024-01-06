<h1><?= $title; ?></h1>

<p>Bonjour <?= $sessionAppUser->appUserFirstName(); ?> <?= $sessionAppUser->appUserLastName(); ?></p>

<h2>Que voulez vous faire ?</h2>

<p>Modifier votre mot de passe ? Cliquez <a href="<?= $appUserUpdatePath; ?>">ici</a></p>
<p>Supprimer votre compte ? Cliquez <a href="<?= $appUserDeletePath; ?>">ici</a></p>
<p>Résoudre un QCM ? Choisissez :
    <?= $qcmReceptionButton; ?>
    <?= $qcmExpeditionButton; ?>
    <?= $qcmGestionButton; ?>
    <?= $qcmPreparationButton; ?>
</p>
<p>Consulter les scores ?
	<?= $userScoresButton; ?>
	<?= $usersBestScoresButton; ?>
</p>

<p><a href="<?= $appUserDisconnectPath; ?>">Deconnexion</a></p>