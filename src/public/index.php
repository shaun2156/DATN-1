<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './../../vendor/autoload.php';

$config = [
  'displayErrorDetails' => true,
  'db' => [
    'host' => 'localhost',
    'user' => 'user',
    'pass' => 'password',
    'dbname' => 'store'
  ]
];

$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();
$container->view = new \Slim\Views\PhpRenderer('../resources/templates/');

$app->get('/', new \App\Controllers\HomeAction($container));

$app->run();
