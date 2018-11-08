<?php
namespace App\Controllers\Suppliers;

use Psr\Container\ContainerInterface;
use App\Models\Supplier;

class StoreAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];

        Supplier::create([
            'name' => $params['name'],
            'address' => $params['address'],
            'description' => $params['description'],
            'contact_no' => $params['contact'],
            'created_by' => $user->employee->employee_id
        ]);

        return $response->withRedirect($this->container->router->pathFor('suppliers.index'));
    }
}
