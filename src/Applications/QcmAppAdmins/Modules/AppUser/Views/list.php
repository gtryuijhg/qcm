<?php 
namespace Aftral\Qcm\Applications\QcmAppAdmins\Modules\AppUser\Views;

use Aftral\Qcm\Library\Entities\AppUser\AppUser;
?>

<h1><?= $title; ?></h1>

<?php 
    if (isset($appUserList))
    {
        foreach ($appUserList as $appUser)
        {   
            $appUser = new AppUser($appUser);
?>
        <p>
            Id : <?= $appUser->id(); ?>, 
            Prénom : <?= $appUser->appUserFirstName(); ?>, 
            Nom : <?= $appUser->appUserLastName(); ?>
            <button class="btn btn-outline-success"><a href="<?= $appUserUpdatePath; ?><?= $appUser->id(); ?>">Modifier le mot de passe</a></button>
            <button class="btn btn-outline-danger"><a href="<?= $appUserDeletePath; ?><?= $appUser->id(); ?>">Supprimer l'utilisateur</a></button>
        </p>
<?php   	
    	}
    }
?>

<p><a href="<?= $appAdminHomePath; ?>">Retour</a></p>