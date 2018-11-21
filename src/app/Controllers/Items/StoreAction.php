<?php
namespace App\Controllers\Items;

use Psr\Container\ContainerInterface;
use App\Models\Item;

class StoreAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];

        Item::create([
            'name' => $params['name'],
            'description' => $params['description'],
            'short_description' => $params['short_description'],
            'current_price' => $params['original_price'],
            'original_price' => $params['original_price'],
            'category_id' => $params['parent_id'],
            'created_by' => $user->employee->employee_id
        ]);

        $_SESSION['message'] = 'Create Item Successful!';

        return $response->withRedirect($this->container->router->pathFor('items.index'));
    }
}
