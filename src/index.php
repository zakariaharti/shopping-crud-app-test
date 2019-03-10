<?php

// Application Entry point

// Composer autoload mechanism
require dirname(__DIR__).'/vendor/autoload.php';

// Configuration file
$configs = require __DIR__.'/config.php';

// Application routes
$routes = require __DIR__.'/routes.php';

// Run the Application

(new \App\core\app\Application($configs, $routes))->run();
