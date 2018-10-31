<?php
namespace App\Controllers\Auth;

use Psr\Container\ContainerInterface;

class LoginAction
{
    protected $container;
    protected $table;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->table = $container->get('db')->table('person');
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();
        $user = $this->table
                    ->where('email', $params['email'])
                    ->where('password', $params['password'])
                    ->get();

        if (count($user) === 0) {
            $_SESSION['error'] = 'Incorrect Credentials';
            return $response->withRedirect($this->container->router->pathFor('home'));
        }
        
        $_SESSION['user'] = $user[0];

        return $response->withRedirect($this->container->router->pathFor('dashboard'));
    }
}
