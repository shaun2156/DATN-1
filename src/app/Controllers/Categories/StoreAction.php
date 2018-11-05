<?php
namespace App\Controllers\Categories;

use Psr\Container\ContainerInterface;
use App\Models\Category;

class StoreAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];

        Category::create([
            'name' => $params['name'],
            'description' => $params['description'],
            'parent_category_id' => $params['parent_id'],
            'created_by' => $user->employee->employee_id
        ]);

        return $response->withRedirect($this->container->router->pathFor('category.index'));
    }
}
