<?php
namespace App\Controllers\Suppliers;

use Psr\Container\ContainerInterface;
use App\Models\Supplier;
use App\Models\Employee;

class EditAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $supplier = Supplier::find($args['id']);
        return $this->container->view->render($response, 'suppliers/edit.twig', [
            'supplier' => $supplier
        ]);
    }
}
