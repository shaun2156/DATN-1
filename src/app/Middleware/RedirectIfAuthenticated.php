<?php

namespace App\Middleware;

class RedirectIfAuthenticated
{
    public function __invoke($request, $response, $next)
    {
        if ($_SESSION['user']) {
            return $response->withRedirect('/dashboard');
        }

        return $next($request, $response);
    }
}
