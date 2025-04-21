<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->is_faculty_admin) {
            abort(403, 'Unauthorized: Faculty Admins only.');
        }

        return $next($request);
    }
}
