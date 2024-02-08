<?php

// AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $allowedRoles = ['admin', 'owner', 'kasir'];
    
        if (Auth::check() && in_array(Auth::user()->role, $allowedRoles)) {
            return $next($request);
        }
    
        return redirect('/dashboard');
    }
    
}

