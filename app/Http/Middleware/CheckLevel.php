<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $level)
    {
        $guard = Auth::getDefaultDriver();
        if (auth()->user()->ds_level != $level && $guard != 'admin') { // 1 Kaprodi && not admin
            abort(404);
            return redirect('/login');
        }

        return $next($request);
    }
}
