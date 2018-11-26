<?php
namespace App\Controllers\Items;

use Psr\Container\ContainerInterface;
use App\Models\Item;

class IndexAction
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args)
    {
        $params = $request->getQueryParams();
        $page = isset($params['page']) ? $params['page'] : 1;

        // Paginate 10 item per page
        $items = Item::with([
            'category',
            'createdBy.person',
            'updatedBy.person'
        ])->paginate(10, ['*'], 'page', $page);
        $items->setPath('/items');

        if (isset($_SESSION['error']) && strlen($_SESSION['error']) !== 0) {
            $args['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['message']) && strlen($_SESSION['message']) !== 0) {
            $args['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $args['items'] = $items;
        return $this->container->view->render($response, 'items/index.twig', $args);
    }
}
