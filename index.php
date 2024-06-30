<?php
require 'vendor/autoload.php';

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// Create App
$app = new App();

// Get Container
$container = $app->getContainer();

// Database Connection
$container['db'] = function () {
    return new PDO('mysql:host=localhost;dbname=users', 'username', 'password');
};

// Define Routes
require 'routes/users.php';

// Run App
$app->run();
