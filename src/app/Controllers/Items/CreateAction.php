<?php
namespace App\Controllers\Items;

use Psr\Container\ContainerInterface;
use App\Models\Item;
use App\Models\Category;

class CreateAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $rootCate = Category::whereNull('parent_category_id')->with(['children'])->first();

        return $this->container->view->render($response, 'items/create.twig', [
            'rootCate' => $rootCate
        ]);
    }
}
