<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminHasAnyRole
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('admin')->user();

        if ($user && $user->roles->isNotEmpty()) {
            return $next($request);
        }

        abort(403, 'Unauthorized: Admin has no assigned role.');
    }
}
