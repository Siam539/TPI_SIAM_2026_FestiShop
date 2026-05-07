<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Restreint l'accès aux utilisateurs ayant le rôle admin uniquement.
 */
class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role == 'admin') {
            return $next($request);
        }

        // Accès refusé si le rôle ne correspond pas
        abort(403);
    }
}
