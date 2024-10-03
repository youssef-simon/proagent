<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
	 	
		$prefix = 'admin';
  		
		if (Str::startsWith($request->path(), $prefix)) {
            return $request->expectsJson() ? null : route('login');
        }
		
		
        return $request->expectsJson() ? null : route('home.login');
    }
}
