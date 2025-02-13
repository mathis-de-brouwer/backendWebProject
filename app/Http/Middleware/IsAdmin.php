<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Import Auth facade cuz ide not happe w auth()->user()



class IsAdmin
{
    
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/'); // Redirect non-admins
        }
        return $next($request);
    }
}
