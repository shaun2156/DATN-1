<?php

namespace App\Middleware;

class RolesAuthorization
{
  private $role;

  public function __construct($roleName)
  {
    $roleConfig = require_once('./../config/roles.php');
    $this->roleId = $roleConfig[$roleName];
  }

  public function __invoke($request, $response, $next)
  {
    $roles = $_SESSION['user']->employee->employeeRoles->pluck("role_id");
    if (in_array($this->roleId, $roles->toArray())) {
      return $next($request, $response);
    } else {
      return $response->withRedirect('/');
    }
  }
}
