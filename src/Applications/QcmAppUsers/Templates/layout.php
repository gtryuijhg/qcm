<?php

namespace Aftral\Qcm\Applications\QcmAppUsers\Templates;

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?= $title; ?></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	</head>
	
	<body>
		<div class="container">
			<?= $content; ?>
		
    		<?php  if ($session->hasFlashMessage()) {
    		      echo $session->getFlashMessage();
    		}?>
		</div>		
	</body>
</html>