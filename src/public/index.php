<?php

require './../../vendor/autoload.php';
require './../routes.php';

session_start();

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
$container = $app->getContainer();

// Loading Template
$container['view'] = function ($container) {
  $view = new \Slim\Views\Twig('../resources/templates/');
  $router = $container->get('router');
  $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
  $view->addExtension(new Slim\Views\TwigExtension($router, $uri));

  return $view;
};

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
