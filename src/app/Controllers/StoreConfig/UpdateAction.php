<?php
namespace App\Controllers\StoreConfig;

use Psr\Container\ContainerInterface;
use App\Models\StoreConfig;

class UpdateAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $_SESSION['user'];
        foreach($params as $key => $value){
          $store_config = StoreConfig::where('config_key','=',$key)->first();
          $store_config->config_value = $value;
          $store_config->updated_by = $user->employee->employee_id;
          $store_config->save();
        }
        return $response->withRedirect($this->container->router->pathFor('store_config.index'));
    }
}
