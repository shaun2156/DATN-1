<?php

require './../../vendor/autoload.php';
require './../routes.php';

// Loading .env var
$dotenv = new Dotenv\Dotenv(__DIR__ . '/../../');
$dotenv->load();

// Configuration - Replace all the getenv with your config
$config = [
  'displayErrorDetails' => true,
  'db' => [
    'driver' => getenv('DB_DRIVER'),
    'host' => getenv('DB_HOST'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'database' => getenv('DB_DATABASE'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
  ]
];

// Init app
$app = new \Slim\App(['settings' => $config]);

// Loading dependencies into container
$container = $app->getContainer();

// Loading Template
$container->view = new \Slim\Views\PhpRenderer('../resources/templates/');

// Loading DBConn & Eloquent
$container['db'] = function ($container) {
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection($container['settings']['db']);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  return $capsule;
};

// Mapping routes
routeMapping($app);

$app->run();
