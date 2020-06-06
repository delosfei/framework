<?php

use delosfei\framework\core\App;

require '../vendor/autoload.php';
$app = new App();
$app->bootstrap();
$db = $app->make('Database');
$db->query();
