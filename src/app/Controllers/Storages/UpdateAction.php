<?php
namespace App\Controllers\Storages;

use Psr\Container\ContainerInterface;
use App\Models\Storage;

class UpdateAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];

        $store = Storage::find($args['id']);
        $store->name = $params['name'];
        $store->address = $params['address'];
        $store->manager_id = $params['manager'];
        $store->updated_by = $user->employee->employee_id;
        $store->save();

        return $response->withRedirect($this->container->router->pathFor('storages.index'));
    }
}
