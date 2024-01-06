<?php

use Aftral\Qcm\Applications\QcmAppUsers\QcmAppUsersApplication;

require_once 'vendor/autoload.php';

//on lance l'application
$app = new QcmAppUsersApplication();
$app->run();