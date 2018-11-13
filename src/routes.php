<?php

function routeMapping($app) {
  $container = $app->getContainer();
  $storeManagerPolicy = new \App\Middleware\RolesAuthorization('storage_manager');
  $authenticated = new \App\Middleware\RedirectIfAuthenticated();

  $middlewares = [
    'storeManagerPolicy' => $storeManagerPolicy,
    'authenticated' => $authenticated,
  ];

  $app
    ->group('', function () use ($app, $container) {
      $app->get('/', new \App\Controllers\Auth\HomeAction($container))->setName('home');
      $app->post('/login', new \App\Controllers\Auth\LoginAction($container))->setName('login');
    })
    ->add($middlewares['authenticated']);

  $app
    ->group('', function () use ($app, $container, $middlewares) {
      $app->get('/dashboard', new \App\Controllers\Auth\DashboardAction($container))->setName('dashboard');
      $app->post('/logout', new \App\Controllers\Auth\LogoutAction($container))->setName('logout');

      // Category Resources
      $app->get('/category', new \App\Controllers\Categories\IndexAction($container))->setName('category.index');
      $app->get('/category/create', new \App\Controllers\Categories\CreateAction($container))->setName('category.create');
      $app->post('/category/store', new \App\Controllers\Categories\StoreAction($container))->setName('category.store');
      $app->get('/category/edit/{id}', new \App\Controllers\Categories\EditAction($container))->setName('category.edit');
      $app->post('/category/update/{id}', new \App\Controllers\Categories\UpdateAction($container))->setName('category.update');

      $app
        ->group('/storages', function () use ($app, $container) {
          $app->get('', new \App\Controllers\Storages\IndexAction($container))->setName('storages.index');
          $app->get('/create', new \App\Controllers\Storages\CreateAction($container))->setName('storages.create');
          $app->post('/store', new \App\Controllers\Storages\StoreAction($container))->setName('storages.store');
          $app->get('/edit/{id}', new \App\Controllers\Storages\EditAction($container))->setName('storages.edit');
          $app->post('/update/{id}', new \App\Controllers\Storages\UpdateAction($container))->setName('storages.update');
          $app->post('/delete/{id}', new \App\Controllers\Storages\DeleteAction($container))->setName('storages.delete');
        })
        ->add($middlewares['storeManagerPolicy']);

        $app
          ->group('/suppliers', function () use ($app, $container) {
            $app->get('', new \App\Controllers\Suppliers\IndexAction($container))->setName('suppliers.index');
            $app->get('/create', new \App\Controllers\Suppliers\CreateAction($container))->setName('suppliers.create');
            $app->post('/store', new \App\Controllers\Suppliers\StoreAction($container))->setName('suppliers.store');
            $app->get('/edit/{id}', new \App\Controllers\Suppliers\EditAction($container))->setName('suppliers.edit');
            $app->post('/update/{id}', new \App\Controllers\Suppliers\UpdateAction($container))->setName('suppliers.update');
            $app->post('/delete/{id}', new \App\Controllers\Suppliers\DeleteAction($container))->setName('suppliers.delete');
          })
          ->add($middlewares['storeManagerPolicy']);
    })
    ->add(new \App\Middleware\Authenticate());
}
