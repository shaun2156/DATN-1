<?php
namespace App\Controllers\Auth;

use Psr\Container\ContainerInterface;
use App\Models\Person;

class LoginAction
{
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke($request, $response, $args) {
        $params = $request->getParsedBody();

        $user = Person::where('email', $params['email'])
            ->where('password', $params['password'])
            ->join('employee', 'person.person_id', '=', 'employee.person_id')
            ->join('employee_role_access', 'employee.employee_id', '=', 'employee_role_access.employee_id')
            ->join('role', 'employee_role_access.role_id', '=', 'role.role_id')
            ->where('role.role_id', '1')
            ->get();

        if (count($user) === 0) {
            $_SESSION['error'] = 'Incorrect Credentials';
            return $response->withRedirect($this->container->router->pathFor('home'));
        }

        $_SESSION['user'] = $user[0];

        return $response->withRedirect($this->container->router->pathFor('dashboard'));
    }
}
