<?php ob_start(); ?>

<h2>Skills :</h2>

<?php 
	foreach ($parameters['skill'] as $skill) {
?>
	<p>Skill : <?= htmlspecialchars($skill['skill_name']); ?></p>
	<p>Description : <?= htmlspecialchars($skill['skill_description']); ?></p>
<?php			
	}	
?>

<p><a href="/jdr/characters-home">Return at character's home</a></p>

<?php	

$content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);