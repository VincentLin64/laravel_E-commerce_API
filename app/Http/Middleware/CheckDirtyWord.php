<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDirtyWord
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $vDirtyWords = ['apple', 'orange'];
        $vInput = $request->all();
        foreach ($vInput as $key => $value) {
            if ($key == 'content') {
                foreach ($vDirtyWords as $dirtyWord) {
                    if (strpos($value, $dirtyWord) !== false) {
                        return \response('dirty', 400);
                    }
                }
            }
        }
        return $next($request);
    }
}
