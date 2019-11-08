<?php

namespace Paparadi\Papaadmin\Middlewares;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {	
        if (!auth('admin')->user()) {
            throw UnauthorizedException::notLoggedIn();
        }
        return $next($request);
    }
}
