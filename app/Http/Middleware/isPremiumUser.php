<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isPremiumUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->user_trial > now()->format('Y-m-d') || $request->user()->billing_ends > now()->format('Y-m-d'))
        {
            return $next($request);
        }else{
            return redirect()->route('subscribe')->with('message','Please subscribe to post a job');
        }

    }
}
