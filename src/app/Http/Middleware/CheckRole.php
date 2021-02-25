<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        if ($user->isSupperAdmin()) {
            return $next($request);
        }

        // Get current user roles
        $userRoles = array_filter(explode(',', $user->group->roles ?? ''));

        if (empty($userRoles)) {
            return abort(401);
        }

        foreach ($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up

            // $roles = explode(',', session('roles'));
            if(in_array($role, $userRoles)) {
                return $next($request);
            }
        }

        return abort(401);
    }
}
