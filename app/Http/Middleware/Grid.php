<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use GooberBlox\Grid\Grid as GridManager;
class Grid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $grid = new GridManager($request);
        if ($grid->validateRCC()) {
            return $next($request);
        }

        abort(403);
    }
}
