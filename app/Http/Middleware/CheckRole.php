<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
<<<<<<< HEAD
        if (! $request->user()->hasPermission($permission)) {
=======
<<<<<<< HEAD
        if (! $request->user()->hasPermission($permission)) {
=======
        if (! $request->user()->can($permission)) {
>>>>>>> c827a1adedba7fb1a66272d44689c45e15fb8fe1
>>>>>>> a9619c76d7468250b94d107373c043f5ce25d05c
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
