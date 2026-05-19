<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $userRole = auth()->user()->role;
        
        // ADMIN CHECK - only admin
        if ($role === 'admin' && $userRole !== 'admin') {
            abort(403, 'Unauthorized - Admin access required');
        }
        
        // HR MANAGER CHECK - admin OR hr_manager
        if ($role === 'hr_manager' && !in_array($userRole, ['admin', 'hr_manager'])) {
            abort(403, 'Unauthorized - HR Manager access required');
        }
        
        // EMPLOYEE CHECK - admin OR hr_manager OR employee
        if ($role === 'employee' && !in_array($userRole, ['admin', 'hr_manager', 'employee'])) {
            abort(403, 'Unauthorized - Employee access required');
        }

        return $next($request);
    }
}