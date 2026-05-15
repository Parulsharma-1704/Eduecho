<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            $educatorRequest = \App\Models\EducatorRequest::where('user_id', $request->user()->id)->first();

            if ($educatorRequest && $educatorRequest->status !== 'approved' && !$request->is('pending-approval') && !$request->is('logout')) {
                return redirect()->route('pending-approval');
            }
        }

        return $next($request);
    }
}
