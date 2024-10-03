<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
		   $localeCode = $request->header('x-locale');

        if ($localeCode) {
            app()->setLocale($localeCode);
            return $next($request);
        }

       
        return $next($request);
    }
    
    } 
