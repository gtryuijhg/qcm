<?php

use Aftral\Qcm\Applications\QcmAppAdmins\QcmAppAdminsApplication;

require_once 'vendor/autoload.php';

//on lance l'application
$app = new QcmAppAdminsApplication();
$app->run();