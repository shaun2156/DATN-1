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

      // Category Resources
      $app->get('/category', new \App\Controllers\Categories\IndexAction($container))->setName('category.index');
      $app->get('/category/create', new \App\Controllers\Categories\CreateAction($container))->setName('category.create');
      $app->post('/category/store', new \App\Controllers\Categories\StoreAction($container))->setName('category.store');
      $app->get('/category/edit/{id}', new \App\Controllers\Categories\EditAction($container))->setName('category.edit');
      $app->post('/category/update/{id}', new \App\Controllers\Categories\UpdateAction($container))->setName('category.update');
    })
    ->add(new \App\Middleware\Authenticate());
}
