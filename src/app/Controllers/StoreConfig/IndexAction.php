<?php
namespace App\Controllers\StoreConfig;

use Psr\Container\ContainerInterface;
use App\Models\StoreConfig;

class IndexAction
{
    protected $store_config_key = [
      "store_name" => 1,
      "store_address" => 2,
      "store_phone" => 3,
      "store_email" => 4,
      "store_about" => 5,
      "contact_description" => 6,
    ];
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
      $store_name = StoreConfig::find($this->store_config_key["store_name"]);
      $store_address = StoreConfig::find($this->store_config_key["store_address"]);
      $store_phone = StoreConfig::find($this->store_config_key["store_phone"]);
      $store_email = StoreConfig::find($this->store_config_key["store_email"]);
      $store_about = StoreConfig::find($this->store_config_key["store_about"]);
      $contact_description = StoreConfig::find($this->store_config_key["contact_description"]);
        return $this->container->view->render($response, 'storeConfig/index.twig', [
          'store_name' => $store_name,
          'store_address' => $store_address,
          'store_phone' => $store_phone,
          'store_email' => $store_email,
          'store_about' => $store_about,
          'contact_description' => $contact_description
        ]);
    }
}
