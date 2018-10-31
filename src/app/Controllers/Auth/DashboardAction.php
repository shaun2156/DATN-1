<?php
namespace App\Controllers\Auth;

use Psr\Container\ContainerInterface;

class DashboardAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $args['user'] = $_SESSION['user'];
        return $this->container->view->render($response, 'dashboard.twig', $args);
    }
}
