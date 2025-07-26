<?php

namespace App\Http\Middleware;

use App\Entities\Subscription;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
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

        if ($user->disabled_by_user_id !== null) {
            Auth::logout();
            return redirect('/login')->with('error', 'Your account has been disabled.');
        }

        if ($user->isA('super-admin')) {
            $path = strtolower($path);
            if (starts_with('clients', $path) || (starts_with('user', $path))) {
                return redirect('/dashboard');
            }
            return $next($request);
        }

        if ($path !== 'subscribe') {
            if (!$user->subscribed('main')) {
                if ($path == 'subscribe/create') {
                    return $next($request);
                } else {
                    $count = Subscription::where('user_id', $user->id)->count();
                    if ($count > 0) {
                        return redirect('/manage/subscription');
                    }
                    return redirect('/subscribe');
                }
            }
        }

        if ($user->subscribed('main')) {
            if ($path == 'subscribe' || $path == 'subscribe/create') {
                return redirect('/clients');
            }
        }

        return $next($request);
    }
}
