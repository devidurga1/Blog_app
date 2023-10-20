<?php

namespace App\Http\Middleware;
use Spatie\Permission\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {

        $user = $request->user();

        $roles = $user->roles->pluck('name');

        if($roles->contains('user')){
            return $next($request);
        }

        return redirect()->back()->withError('Unauthorized');
    }
}
