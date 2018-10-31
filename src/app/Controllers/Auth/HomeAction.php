<?php
namespace App\Controllers\Auth;

use Psr\Container\ContainerInterface;

class HomeAction
{
    protected $container;
    protected $table;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        if ($_SESSION['error'] && strlen($_SESSION['error']) !== 0) {
            $args['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        return $this->container->view->render($response, 'layout.twig', $args);
    }
}
