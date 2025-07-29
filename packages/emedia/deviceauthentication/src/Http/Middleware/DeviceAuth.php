<?php

namespace EMedia\DeviceAuthentication\Http\Middleware;

use Closure;
use DeviceAuthentication;
use Response;

class DeviceAuth
{
    public function handle($request, Closure $next) {

        $token = $request->bearerToken();

        if($token == null || $token != config('api.key')) {
            abort(401, 'Invlid API key.');
        }

        return $next($request);
    }
}
