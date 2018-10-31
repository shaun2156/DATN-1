<?php
namespace App\Controllers;

use Psr\Container\ContainerInterface;

class HomeAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        return $this->container->view->render($response, 'layout.phtml');
    }
}
