<?php
namespace App\Controllers\Categories;

use Psr\Container\ContainerInterface;
use App\Models\Category;

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
        $categories = Category::with([
            'parent',
            'createdBy.person',
            'updatedBy.person'
        ])->paginate(10, ['*'], 'page', $page);
        $categories->setPath('/category');

        return $this->container->view->render($response, 'categories/index.twig', [
            'categories' => $categories
        ]);
    }
}
