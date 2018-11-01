<?php

namespace App\Controllers\Storages;

use Psr\Container\ContainerInterface;
use App\Models\Storage;

class DeleteAction
{
    protected $container;
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    public function __invoke($request, $response, $args) {
        $store = Storage::find($args['id']);
        $store->delete();
        return $response->withRedirect($this->container->router->pathFor('storages.index'));
    }
}
