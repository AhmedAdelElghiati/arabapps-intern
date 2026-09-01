<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Reject students that only hold a guest account.
     *
     * Must run behind `auth:student`.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $student = $request->user('student');

        if (! $student || $student->is_guest) {
            return response()->json([
                'message' => 'This action requires a full account.',
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
