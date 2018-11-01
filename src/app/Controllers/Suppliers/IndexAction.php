<?php
namespace App\Controllers\Suppliers;

use Psr\Container\ContainerInterface;
use App\Models\Supplier;

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
        $suppliers = Supplier::paginate(10, ['*'], 'page', $page);
        $suppliers->setPath('/suppliers');

        return $this->container->view->render($response, 'suppliers/index.twig', [
            'suppliers' => $suppliers
        ]);
    }
}
