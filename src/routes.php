<?php

function routeMapping($app) {
  $container = $app->getContainer();

  $app
    ->group('', function () use ($app, $container) {
      $app->get('/', new \App\Controllers\Auth\HomeAction($container))->setName('home');
      $app->post('/login', new \App\Controllers\Auth\LoginAction($container))->setName('login');
    })
    ->add(new \App\Middleware\RedirectIfAuthenticated());

  $app
    ->group('', function () use ($app, $container) {
      $app->get('/dashboard', new \App\Controllers\Auth\DashboardAction($container))->setName('dashboard');
      $app->post('/logout', new \App\Controllers\Auth\LogoutAction($container))->setName('logout');
    })
    ->add(new \App\Middleware\Authenticate());
}
