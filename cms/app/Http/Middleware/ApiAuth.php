<?php

namespace App\Http\Middleware;

use App\Models\AppUserModel;
use Closure;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        $user = AppUserModel::where('api_token', $token)->first();

        if ($user) {
            return $next($request);
        }
        return response([
            'message' => 'Unauthorized'
        ], 403);
    }
}
