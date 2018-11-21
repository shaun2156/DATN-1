<?php
namespace App\Controllers\Items;

use Psr\Container\ContainerInterface;
use App\Models\Item;

class UpdateAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];
        $item = Item::where('item_id', $args['id']);
        
        $item->update([
            'name' => $params['name'],
            'description' => $params['description'],
            'short_description' => $params['short_description'],
            'current_price' => $params['original_price'],
            'original_price' => $params['original_price'],
            'category_id' => $params['parent_id'],
            'updated_by' => $user->employee->employee_id
        ]);

        $_SESSION['message'] = 'Update Item Successful!';

        return $response->withRedirect($this->container->router->pathFor('items.index'));
    }
}
