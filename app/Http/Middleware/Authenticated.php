<?php

namespace App\Http\Middleware;

use Closure;

class Authenticated
{
    public function handle($request, Closure $next)
    {
        if($this->value = $request->session()->get('admin_id')) {
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}