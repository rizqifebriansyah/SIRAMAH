<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class hak_akses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$hak_akses)
    {
        if(in_array($request->user()->hak_akses,$hak_akses)){
            return $next($request);
        }
        return redirect('/logout');
    }
}