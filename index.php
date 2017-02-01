<?php

require 'vendor/autoload.php';

// Loading environment variable from .env file
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$app = require 'src/bootstrap.php';

// Routes
include 'src/routes.php';

// Starting the app
$app->run();