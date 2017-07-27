<?php
/**
 * Created by Erik.
 */

namespace App\Middleware;


class CorsMiddleware
{
    public function __invoke($request, $response, $next)
    {
        $response->cors($request)
            ->allowOrigin(['*'])
            ->allowMethods(['*'])
            ->allowHeaders(['Access-Control-Allow-Headers', 'Origin,Accept', 'X-Requested-With', 'Content-Type', 'Access-Control-Request-Method', 'Access-Control-Request-Headers'])
            ->allowCredentials()
            ->maxAge(3600)
            ->build();

        return $next($request, $response);
    }
}