<?php

namespace App\Http\Middleware;

use App\Enums\UserTypesEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
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
        if($user->role == UserTypesEnum::SUPER_ADMIN)
        {
            return $next($request);
        }
    }
}
