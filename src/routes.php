<?php

function routeMapping($app) {
  $container = $app->getContainer();
  $app->get('/', new \App\Controllers\HomeAction($container));
}
