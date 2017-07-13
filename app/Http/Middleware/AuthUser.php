<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use App\Http\Services\User\AuthUserToken;
use App\Http\ResponseBack;

class AuthUser
{

    public function handle($request, Closure $next, $guard = null)
    {
        switch (true) 
        {
            case $request->isMethod('options'):
                return new Response('OK', 200);
                break;

            case empty($request->header('X-CSRF-TOKEN'));
                return ResponseBack::resultToken();
                break;

            case $token=AuthUserToken::index($request->header('X-CSRF-TOKEN')):
                $request->attributes->add(compact('token'));
                return $next($request);
                break;

            default:   
                return ResponseBack::resultToken();
                break;
        } 
    }
}
