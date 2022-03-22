<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if ($this->auth->guard($guard)->guest()) {
        //     return response('Unauthorized.', 401);
        // }

        $userId = [
            '80000000-8000-8000-8000-000000000008',
            '80000008-8008-8008-8008-800000000008',
            '90000000-9000-9000-9000-000000000009',
            '90000009-9009-9009-9009-900000000009',
        ];

        $request_user = $request->header('user-id');
        if (!in_array($request_user, $userId)) return response('Unauthorized.', 401);

        return $next($request);
    }
}
