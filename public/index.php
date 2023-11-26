<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Router;
use App\Controllers\SubmitController;


require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('VIEW_PATH', __DIR__ . '/../views');

$router = new Router();

$router
    ->get('/', [SubmitController::class, 'submitView']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();