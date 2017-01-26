<?php

require 'vendor/autoload.php';

$app = require 'src/bootstrap.php';

// Routes
include 'src/routes.php';

// Starting the app
$app->run();