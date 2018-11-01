<?php
namespace App\Controllers\Suppliers;

use Psr\Container\ContainerInterface;
use App\Models\Supplier;

class UpdateAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];

        $supplier = Supplier::find($args['id']);
        $supplier->name = $params['name'];
        $supplier->address = $params['address'];
        $supplier->description = $params['description'];
        $supplier->contact_no = $params['contact'];
        $supplier->updated_by = $user->employee->employee_id;
        $supplier->save();

        return $response->withRedirect($this->container->router->pathFor('suppliers.index'));
    }
}
