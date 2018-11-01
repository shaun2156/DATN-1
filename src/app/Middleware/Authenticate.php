<?php

namespace App\Middleware;

class Authenticate
{
  public function __invoke($request, $response, $next)
  {
    if (!$_SESSION['user']) {
      return $response->withRedirect('/');
    }

    return $next($request, $response);
  }
}
