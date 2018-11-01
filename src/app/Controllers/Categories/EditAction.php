<?php
namespace App\Controllers\Categories;

use Psr\Container\ContainerInterface;
use App\Models\Category;

class EditAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        // Only root category has a null-parent-id
        $rootCategory = Category::whereNull('parent_category_id')->with(['children'])->first();
        $category = Category::where('category_id', $args['id'])->first();

        return $this->container->view->render($response, 'categories/edit.twig', [
            'root' => $rootCategory,
            'category' => $category,
        ]);
    }
}
