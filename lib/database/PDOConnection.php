<?php

$database = new PDO('mysql:host=localhost;dbname=gamejdr', 'root', '',
array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));