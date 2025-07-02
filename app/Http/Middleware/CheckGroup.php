<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGroup
{
    public function handle(Request $request, Closure $next, string $groupName): Response
    {
        if (! $request->user() || ! $request->user()->hasGroup($groupName)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
