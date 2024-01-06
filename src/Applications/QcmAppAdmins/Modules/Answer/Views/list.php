<?php
namespace Aftral\Qcm\Applications\QcmAppAdmins\Modules\Answer\Views;

use Aftral\Qcm\Library\Entities\Answer\Answer;

?>

<h1><?= $title; ?></h1>

<?php 
    if (isset($answerList))
    {
        foreach ($answerList as $answer)
        {   
            $answer = new Answer($answer);
?>
        <p>
            Id : <?= $answer->id(); ?>, 
            Réponse : <?= $answer->answerBody(); ?>, 
            Question liée : <?= $answer->questionId(); ?>,
            Solution d'une question : <?= $answer->isSolution(); ?>           
            <button class="btn btn-outline-success"><a href="<?= $answerUpdatePath; ?><?= $answer->id(); ?>">Modifier la réponse</a></button>
            <button class="btn btn-outline-danger"><a href="<?= $answerDeletePath; ?><?= $answer->id(); ?>">Supprimer la réponse</a></button>
        </p>
<?php   	
    	}
    }
?>

<p><a href="<?= $appAdminHomePath; ?>">Retour</a></p>