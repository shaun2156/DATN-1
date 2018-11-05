<?php
namespace App\Controllers\Categories;

use Psr\Container\ContainerInterface;
use App\Models\Category;

class CreateAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        // Only root category has a null-parent-id
        $root = Category::whereNull('parent_category_id')->with(['children'])->first();

        return $this->container->view->render($response, 'categories/create.twig', [
            'root' => $root
        ]);
    }
}
