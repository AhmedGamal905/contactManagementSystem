<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Router;
use App\Controllers\UserController;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('VIEW_PATH', __DIR__ . '/../views'); 

$router = new Router();

$router
    ->get('/', [UserController::class, 'submitView'])
    ->post('/processEntries', [UserController::class, 'processEntries'])
    ->get('/successView', [UserController::class, 'successView'])
    ->get('/errorView', [UserController::class, 'errorView'])
    ->post('/deleteUser', [UserController::class, 'deleteUser'])
    ->post('/userView', [UserController::class, 'userView']);
    

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();