<?php

namespace App\Http\Middleware;

use App\Enums\UserRoles;
use App\User;
use Closure;
use Auth;

class BillingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::User();
        $trialEnds = \Carbon\Carbon::parse($user->trial_ends_at);
        $now = \Carbon\Carbon::now();
        if ( !$user->subscription('subscription') && $user->plan != 'Free' && $trialEnds < $now ) {
            return redirect('/settings');
        }

        /**
         * This variable is available globally on all views, and sub-views
         */
        return $next($request);
    }
}
