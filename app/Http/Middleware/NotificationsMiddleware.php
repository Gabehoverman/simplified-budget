<?php

namespace App\Http\Middleware;

use App\Enums\UserRoles;
use App\User;
use Closure;
use Auth;

class NotificationsMiddleware
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
        $notifications = [];
        if (!$user) {
            $notifications = array();
            $notificationsCount = 0;
        } else {
            $notifications = Auth::User()->notifications()->orderBy('id', 'DESC')->get();
            // $notificationsCount = count($notifications);
        }

        /**
         * This variable is available globally on all views, and sub-views
         */
        view()->share('notifications', $notifications);
        // view()->share('notificationsCount', $notificationsCount);


        return $next($request);
    }
}
