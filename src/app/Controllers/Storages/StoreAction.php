<?php
namespace App\Controllers\Storages;

use Psr\Container\ContainerInterface;
use App\Models\Storage;

class StoreAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];

        Storage::create([
            'name' => $params['name'],
            'address' => $params['address'],
            'manager_id' => $params['manager'],
            'created_by' => $user->employee->employee_id
        ]);

        return $response->withRedirect($this->container->router->pathFor('storages.index'));
    }
}
