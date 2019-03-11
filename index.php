<?php

// Application Entry point

// Composer autoload mechanism
require 'vendor/autoload.php';

// Configuration file
$configs = require 'src/config.php';

// Application routes
$routes = require 'src/routes.php';

// helpers functions
require 'src/helpers/helpers.php';

// Run the Application

(new \App\core\app\Application($configs, $routes))->run();
