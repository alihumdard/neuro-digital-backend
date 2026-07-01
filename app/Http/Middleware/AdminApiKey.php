<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $providedKey = $request->header('X-Admin-Api-Key');
        $expectedKey = config('app.admin_api_key');

        if (! $expectedKey || ! $providedKey || ! hash_equals($expectedKey, $providedKey)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
