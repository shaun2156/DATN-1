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
        $storeItemQuantity = Storage::join('item_importing', 'storage.storage_id', '=', 'item_importing.storage_id')
            ->join('item_import_detail', 'item_importing.importing_id', '=', 'item_import_detail.item_import_id')
            ->where('storage.storage_id', $args['id'])
            ->sum('item_import_detail.quantity');

        if (intval($storeItemQuantity) !== 0) {
            $_SESSION['error'] = 'Storage is not empty. Please remove all items and try again.';
        } else {
            $store = Storage::find($args['id']);
            $store->delete();
            $_SESSION['message'] = 'Delete Success!';
        }

        return $response->withRedirect($this->container->router->pathFor('storages.index'));
    }
}
