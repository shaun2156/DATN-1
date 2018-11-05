<?php
namespace App\Controllers\Categories;

use Psr\Container\ContainerInterface;
use App\Models\Category;

class UpdateAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];

        $cate = Category::find($args['id']);
        $cate->name = $params['name'];
        $cate->description = $params['description'];
        $cate->parent_category_id = $params['parent_id'];
        $cate->updated_by = $user->employee->employee_id;
        $cate->save();

        return $response->withRedirect($this->container->router->pathFor('category.index'));
    }
}
