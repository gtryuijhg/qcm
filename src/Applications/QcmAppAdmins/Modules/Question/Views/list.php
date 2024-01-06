<?php 
namespace Aftral\Qcm\Applications\QcmAppAdmins\Modules\Question\Views;

use Aftral\Qcm\Library\Entities\Question\Question;

?>

<h1><?= $title; ?></h1>

<?php 
    if (isset($questionList))
    {
        foreach ($questionList as $question)
        {
            $question = new Question($question);
?>
		<p>
			Id : <?= $question->id(); ?>, 
            Question : <?= $question->questionBody(); ?>, 
            Type de question : <?= $question->questionType(); ?>,
            Nombre de solutions : <?= $question->solutionsNumber(); ?>     
            <button class="btn btn-outline-primary"><a href="<?= $answerCreatePath; ?><?= $question->id(); ?>">Créer une réponse</a></button>    
            <button class="btn btn-outline-success"><a href="<?= $questionUpdatePath; ?><?= $question->id(); ?>">Modifier la question</a></button>
            <button class="btn btn-outline-danger"><a href="<?= $questionDeletePath; ?><?= $question->id(); ?>">Supprimer la question</a></button>
		</p>
<?php
        }
    }
?>

<p><a href="<?= $appAdminHomePath; ?>">Retour</a></p>