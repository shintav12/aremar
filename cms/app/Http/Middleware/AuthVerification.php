<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AuthVerification
{
   public function handle($request, Closure $next)
   {;
        if(!is_null($request->segment(1))) {
            $user = Session::get('user');
            if (!isset($user)) {
                return \redirect()->route('index');
            } else {
                $key = array_search($request->segment(1), array_column($user->permissions_full, 'menu_active'));
                if (!is_numeric($key)){
                    return \redirect()->route(array_values($user->permissions_full)[0]['menu_active']);
                }
            }
        }

        return $next($request);
    }
}
