<?php
namespace App\Controllers;

use Psr\Container\ContainerInterface;

class HomeAction
{
    protected $container;
    protected $table;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->table = $container->get('db')->table('person');
    }

    public function __invoke($request, $response, $args) {
        $person = $this->table->where('person_id', 1)->get();
        return $this->container->view->render($response, 'layout.phtml', [
            'person' => $person[0]
        ]);
    }
}
