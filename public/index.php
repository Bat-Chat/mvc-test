<?php

use app\core\Application;
use app\controllers\MainController;
use Dotenv\Dotenv as Dotenv;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$rootDir = dirname(__DIR__);

$dotenv = Dotenv::createImmutable($rootDir);
$dotenv->load();
$config = [
    'userClass' => \app\models\UserModel::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application($rootDir, $config);

$app->router->get('/', [MainController::class, 'home']);
$app->router->get('/register', [MainController::class, 'register']);
$app->router->post('/register', [MainController::class, 'register']);
$app->router->get('/login', [MainController::class, 'login']);
$app->router->post('/login', [MainController::class, 'login']);
$app->router->get('/logout', [MainController::class, 'logout']);

$app->run();