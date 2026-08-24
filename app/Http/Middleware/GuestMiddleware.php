<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $student=$request->user('student');
        if ($student->is_guest=true) {
            # code...
            return response()->json([
                'message'=>'unauthroized',
            ]);
        }
        return $next($request);
    }
}
