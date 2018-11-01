<?php
namespace App\Controllers\Storages;

use Psr\Container\ContainerInterface;
use App\Models\Storage;

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
        $storages = Storage::with(['manager.person'])->paginate(10, ['*'], 'page', $page);
        $storages->setPath('/storages');

        if ($_SESSION['error'] && strlen($_SESSION['error']) !== 0) {
            $args['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        if ($_SESSION['message'] && strlen($_SESSION['message']) !== 0) {
            $args['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $args['storages'] = $storages;
        return $this->container->view->render($response, 'storages/index.twig', $args);
    }
}
