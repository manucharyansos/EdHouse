<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        return Inertia::render('Error', [
            'message' => 'Դուք չունեք ադմինի իրավունքներ։'
        ])->toResponse($request)->setStatusCode(403);
    }
}
