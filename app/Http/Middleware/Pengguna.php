<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Pengguna
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if ($request->user()->isPengguna()) {
                return $next($request);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
