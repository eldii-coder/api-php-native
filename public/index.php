<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load file router dan controller
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Controllers/UserController.php';

use Src\Router;
use Src\Controllers\UserController;

// Buat instance router
$router = new Router();

// Definisikan route
$router->add('GET', '/api-php-native/public/api/v1/users', 'UserController@index');
$router->add('GET', '/api-php-native/public/api/v1/users/1', 'UserController@show');

// Jalankan router
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
