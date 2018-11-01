<?php
namespace App\Controllers\Suppliers;

use Psr\Container\ContainerInterface;

class CreateAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        return $this->container->view->render($response, 'suppliers/create.twig');
    }
}
