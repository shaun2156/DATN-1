<?php

namespace App\Middleware;

class RolesAuthorization
{
    private $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function __invoke($request, $response, $next)
    {
        if ($_SESSION['user']->employee->hasRole($this->role)) {
            return $next($request, $response);
        } else {
            return $response->withRedirect('/');
        }
    }
}
