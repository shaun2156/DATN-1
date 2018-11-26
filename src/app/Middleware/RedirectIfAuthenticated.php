<?php

namespace App\Middleware;

class RedirectIfAuthenticated
{
    public function __invoke($request, $response, $next)
    {
        if (isset($_SESSION['user'])) {
            return $response->withRedirect('/dashboard');
        }

        return $next($request, $response);
    }
}
