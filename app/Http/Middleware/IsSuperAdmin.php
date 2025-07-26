<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = Auth::user();
        $path = $request->path();

        if ($user->disabled_by_user_id) {
            Auth::logout();
            return redirect('/login')->with('error', 'Your account has been disabled.');
        }

        if (!$user->isA('super-admin')) {
            $path = strtolower($path);
            // if (!starts_with('clients', $path)) {
            if (!Str::startsWith($path, 'clients')) {

                return redirect('/clients');
            }
            return redirect('user/profile');
        }

        return $next($request);
    }
}
