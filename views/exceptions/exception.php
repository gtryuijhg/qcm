<?php ob_start(); ?>

<?= $parameters['errorMessage']; ?>

<a href="<?= $_SERVER['HTTP_REFERER']; ?>">Return</a>

<?php $content = ob_get_clean();

$template = new Template();
$template->getTemplate($parameters, $content);