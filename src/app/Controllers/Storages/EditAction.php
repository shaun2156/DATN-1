<?php
namespace App\Controllers\Storages;

use Psr\Container\ContainerInterface;
use App\Models\Storage;
use App\Models\Employee;

class EditAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $storeManager = Employee::with(['employeeRoles.role' => function($query) {
            $query->where('role_id', 2);
        }, 'person'])->get();

        $store = Storage::find($args['id'])->first();
        return $this->container->view->render($response, 'storages/edit.twig', [
            'managers' => $storeManager,
            'storage' => $store
        ]);
    }
}
