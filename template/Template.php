<?php

class Template
{
	public function getTemplate($parameters, $content)
	{
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<title><?= $parameters['title']; ?></title>
				<meta charset="utf-8">
				<link rel="stylesheet" href="css/bootstrap.min.css">
			</head>

			<body class="container">
				<h1><?= $parameters['title']; ?></h1>

				<?= $content; ?>

				<script src="lib/scripts/dices.js"></script>
			</body>
		</html>
		<?php
	}
}