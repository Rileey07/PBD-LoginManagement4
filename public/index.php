<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ProgrammerZamanNow\Belajar\PHP\MVC\App\Router;
use ProgrammerZamanNow\Belajar\PHP\MVC\Controller\HomeController;
use ProgrammerZamanNow\Belajar\PHP\MVC\ControllerUserController;

Database::getConnection('prod');
//Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);
// User Controller
Router::add('GET', '/user\register', UserController::class, 'register', []);
Router::add('POST', '/user\register', UserController::class, 'postRegister', []);
Router::add('GET', '/user\login', UserController::class, 'login', []);
Router::add('POST', '/user\login', UserController::class, 'postlogin', []);
Router::run();