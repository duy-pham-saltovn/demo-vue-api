<?php

namespace App\Http\Middleware;

use Closure;

class IsAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->isAccess()) {
            return $next($request);
        }

        return redirect()->route('admin.access.denied');
    }
}
