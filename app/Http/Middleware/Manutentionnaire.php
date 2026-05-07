<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Restreint l'accès aux manutentionnaires et aux admins.
 * L'admin a accès à tout, y compris les routes manutentionnaire.
 */
class Manutentionnaire
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role == 'manutentionnaire' || auth()->user()->role == 'admin') {
            return $next($request);
        }

        // Accès refusé si le rôle ne correspond pas
        abort(403);
    }
}
