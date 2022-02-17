<?php

namespace App\Http\Middleware;

use App\Enums\UserTypesEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPlusMiddleware
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
        $user = Auth::user();
        if(in_array($user->role,UserTypesEnum::ADMIN_ROLES))
        {
            return $next($request);
        }
    }
}
