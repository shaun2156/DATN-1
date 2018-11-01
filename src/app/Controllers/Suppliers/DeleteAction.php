<?php
namespace App\Controllers\Suppliers;

use Psr\Container\ContainerInterface;
use App\Models\Supplier;

class DeleteAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $supplier = Supplier::find($args['id']);
        $supplier->delete();

        return $response->withRedirect($this->container->router->pathFor('suppliers.index'));
    }
}
