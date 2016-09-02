<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require '/var/www/vendor/autoload.php';
if(getenv('APPLICATION_ENV') === 'development') {
    Dotenv::load('/var/www/env');
}

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../app'));

// Instantiate the app
$app = new \Slim\App();

// Set up dependencies
require APPLICATION_PATH . '/dependencies.php';

// Register middleware
require APPLICATION_PATH . '/middleware.php';

// Register routes
require APPLICATION_PATH . '/routes.php';

// Run!
$app->run();
