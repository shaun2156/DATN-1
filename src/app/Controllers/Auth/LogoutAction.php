<?php
namespace App\Controllers\Auth;

use Psr\Container\ContainerInterface;

class LogoutAction
{
    protected $container;
    protected $table;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
      session_unset();
      return $response->withRedirect($this->container->router->pathFor('home'));
    }
}
