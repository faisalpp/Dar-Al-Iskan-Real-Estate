<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $language = $request->session()->get('language');
        if(isset($language)){
            app()->setLocale($language);
        }else{
            app()->setLocale('ar');
        }
        return $next($request);
    }
}
