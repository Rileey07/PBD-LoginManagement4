<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ProgrammerZamanNow\Belajar\PHP\MVC\App\Router;
use ProgrammerZamanNow\Belajar\PHP\MVC\Controller\HomeController;
use ProgrammerZamanNow\Belajar\PHP\MVC\ControllerUserController;
use ProgrammerZamanNow\Belajar\PHP\MVC\MustNotLoginMiddleware;
use ProgrammerZamanNow\Belajar\PHP\MVC\MustLoginMiddleware;
Database::getConnection('prod');
//Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);
// User Controller
Router::add('GET', '/user\register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/user\register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/user\login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/user\login', UserController::class, 'postlogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/user\logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::run();