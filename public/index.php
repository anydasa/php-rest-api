<?php

require_once __DIR__.'/../src/autoload.php';

use \Rest\Server;

$configDir = __DIR__.'/../config/';

$restServer = new Server($configDir);
$restServer->run();

