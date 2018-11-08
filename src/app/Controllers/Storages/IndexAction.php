<?php
namespace App\Controllers\Storages;

use Psr\Container\ContainerInterface;
use App\Models\Storage;

class IndexAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getQueryParams();
        $page = $params['page'] !== null ? $params['page'] : 1;

        // Paginate 10 item per page
        $storages = Storage::with(['manager.person'])->paginate(10, ['*'], 'page', $page);
        $storages->setPath('/storages');

        return $this->container->view->render($response, 'storages/index.twig', [
            'storages' => $storages
        ]);
    }
}
